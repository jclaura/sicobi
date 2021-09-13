<?php

namespace App\Http\Livewire\Usuarios;

use Livewire\Component;
use App\Models\User;  
use App\Models\Empleado;  
use App\Models\Tienda;  
use Spatie\Permission\Models\Role;  

use Carbon\Carbon;

use Livewire\WithPagination;  
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\Storage;

use App\Http\Traits\SetImageTrait; 

class UsuariosComponente extends Component
{      

    use WithPagination;
    use WithFileUploads;

    use SetImageTrait;

    protected $paginationTheme = 'bootstrap'; 

    //DATOS TABLA USUARIO
    public $name, $email, $password, $rol='Administrador';

    //DATOS TABLA EMPLEADO
    public $ci_emp, $dir_emp, $tel_emp, $estado_emp, $fecha_ing_emp, $sueldo_emp, $avatar;

    public $roles;

    //VARIABLES DE COMPONENTE
    public $tienePerfil=0;//uNO USADOsado    
    public $ids;
    public $tiendas, $tienda_id=1;
    
    /*VARIABLE PARA QUE EL USUARIO CARGUE FOTO PRODUCTO */
    /* SE DEBE USAR LOS SIGUIENTES USES: use Livewire\WithFileUploads;, use WithFileUploads;*/
    public $photo, $iteration; //TRUCO PARA LIMPIAR SELECIONAR ARCHIVO EN FORMULARIO BLADE
    //RUTA DONDE SE GUARDARA LA FOTO UPLOAD*/
    public $rutaFotosUsuarios = 'FotosUsuarios';  
    
    protected $listeners = ['destroy'];

    //REGLAS DE VALIDACION DE FORMULARIO
    protected $rules = [   
        'ci_emp'  => 'required',                       
        'dir_emp'  => 'required',                 
        'tel_emp'  => 'required',           
        'sueldo_emp'  => 'required|numeric'
    ]; 

    protected $messages = [
        'ci_emp.required' => 'Campo requerido',             
        'dir_emp.required' => 'Campo requerido',
        'tel_emp.required' => 'Campo requerido',
        'sueldo_emp.required' => 'Campo requerido',
    ];

    public function resetVar(){        
        $this->reset(['ci_emp', 'dir_emp', 'tel_emp', 'sueldo_emp', 'tienda_id', 'fecha_ing_emp']);        
    }

    public function mount(){
        $userId = auth()->user()->id;   
        
        $user = User::find($userId);
        $this->roles = Role::all();              
        $this->tiendas = [];
        $this->fecha_ing_emp = Carbon::now()->format('Y-m-d'); 
    }

    public function render()
    {
        return view('livewire.usuarios.usuarios-componente', [
            'usuarios' =>  User::all()
        ]);
    } 

    public function registrar(){          
        $validatedData = $this->validate([
            'name' => 'required',                                 
            'email' => 'required',
            'password' => 'required',
        ]);                
        User::create([
            'name' => $this->name,               
            'email' => $this->email,                      
            'password' => bcrypt($this->password),        
            'rol' => $this->rol,                 
        ]);
        $userId = User::get()->last();
        $userId->assignRole($this->rol);

        $this->emit('alert',['type'=>'success','message'=>'Usuario registrado']);   
        $this->emit('HideCreateUsuarioModal'); 
        $this->reset(['name', 'email', 'password', 'rol']);      
    }

    public function verPerfil($userId)
    {   
        $this->ids = $userId; 
        $this->tiendas = Tienda::all();
        $empleado = Empleado::where('user_id', '=',$userId )->get()->first();                             
        $this->tienda_id = $empleado->tienda_id;
        $this->ci_emp = $empleado->ci_emp;
        $this->dir_emp = $empleado->dir_emp;
        $this->tel_emp = $empleado->tel_emp;
        $this->fecha_ing_emp = $empleado->fecha_ing_emp;
        $this->sueldo_emp = $empleado->sueldo_emp;
        
        $this->emit('ShowEditPerfilModal');  
    } 

    public function crearPerfil($userId)
    {      
        $this->ids = $userId;  
        $this->tiendas = Tienda::all();
        $this->resetVar();
        $this->emit('ShowCreatePerfilModal');  
    } 

    public function guardarPerfil()
    {                
        $this->validate();  
        if ($this->photo <> null){
            $nombreFotoUsuarioGenerado = $this->setImage($this->photo, $this->rutaFotosUsuarios);
            $this->photo = null; 
            $this->iteration++;//BORRA NOMBRE DE ARCHIVO ANTERIOR SELECCIONADO (TRUCO)  
        }
        else{
            $nombreFotoUsuarioGenerado = 'default_avatar.png'; 
        }   

        if ($this->ids) {
            Empleado::create([
                'user_id' => $this->ids,               
                'tienda_id' => $this->tienda_id,                      
                'ci_emp' => $this->ci_emp,               
                'dir_emp' => $this->dir_emp,
                'tel_emp' => $this->tel_emp,  
                'estado_emp'  => 0,        
                'fecha_ing_emp' => $this->fecha_ing_emp,                  
                'sueldo_emp' => $this->sueldo_emp,
                'avatar' => $nombreFotoUsuarioGenerado,                
            ]);
            $this->emit('alert',['type'=>'success','message'=>'Registro guardado']);
            $this->resetVar();  
            $this->emit('HideCreatePerfilModal');
        }                    
    } 

    public function destroy(User $registro){                     
        $registro->delete();
        $empleado = Empleado::where('user_id', '=',$registro->id)->get()->first(); 
        if($empleado){
            //SI EL REGISTRO TIENE AVATAR SE ELIMINA LA IMAGEN
            if ($empleado->avatar <> 'default_avatar.png'){
                Storage::disk('public')->delete($this->rutaFotosUsuarios.'/'.$empleado->avatar); 
            }                   
        }               
    }   
    
}
