<?php

namespace App\Http\Livewire\Proveedores;

use Livewire\Component; 
use Illuminate\Support\Facades\Session;
//ADICIONADO
use App\Models\Proveedor;  
use Livewire\WithPagination;  
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\Storage;

use App\Http\Traits\SetImageTrait;

class ProveedoresComponente extends Component
{
    use WithPagination;
    use WithFileUploads;

    use SetImageTrait; 

    protected $paginationTheme = 'bootstrap';
    
    //CAMPOS DE LA TABLA PROVEEDORES EN EL FORMULARIO    
    public $emp_prov;//CAMPO VALIDADO
    public $tel_prov;//CAMPO OPCIONAL
    public $dir_prov;//CAMPO OPCIONAL
    public $web_prov;//CAMPO OPCIONAL
    public $email_prov;//CAMPO OPCIONAL
    public $pais_prov;//CAMPO VALIDADO
    public $prod_prov;//CAMPO OPCIONAL

    //VARIABLES GLOBAL 
    public $ids;

    /*VARIABLE PARA QUE EL USUARIO CARGUE FOTO PRODUCTO */
    /* SE DEBE USAR LOS SIGUIENTES USES: use Livewire\WithFileUploads;, use WithFileUploads;*/
    public $photo, $iteration; //TRUCO PARA LIMPIAR SELECIONAR ARCHIVO EN FORMULARIO BLADE
    
    //RUTA DONDE SE GUARDARA LA FOTO SUBIDA*/
    public $rutaFotosContactos = 'FotosContactos';

    protected $listeners = ['destroy'];    

    //REGLAS DE VALIDACION DE FORMULARIO
    protected $rules = [                
        'emp_prov'   => 'required|min:5|max:100|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',                        
        'pais_prov'   => 'required|min:4|max:15|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',                        
        'photo' => 'max:1024'
    ];

    protected $messages = [
        'emp_prov.required' => 'Nombre de empresa requerido',             
        'emp_prov.min' => 'Nombre de empresa debe contener mínimo 5 caracteres',
        'emp_prov.max' => 'Nombre de empresa debe contener máximo 100 caracteres',        
        'pais_prov.required' => 'Nombre de pais requerido',             
        'pais_prov.min' => 'Nombre de pais debe contener mínimo 4 caracteres',
        'pais_prov.max' => 'Nombre de pais debe contener máximo 15 caracteres', 
        'photo.max' => "El tamaño máximo de archivo para cargar es 1 MB (1024 KB). Si está subiendo una foto, intente reducir su resolución para que sea inferior a 1 MB"
    ];
    
    public function resetVar(){
        $this->reset(['emp_prov','tel_prov', 'dir_prov', 'web_prov', 'email_prov', 'pais_prov', 'prod_prov']);        
    }

    public function render()
    {
        return view('livewire.proveedores.proveedores-componente', [
            'proveedor' => Proveedor::paginate(5)
        ]);
    } 
    
    public function store()
    {        
        $this->validate();
        $proveedor = Proveedor::where('emp_prov', '=', ucfirst($this->emp_prov))->first();                      
        if (empty($proveedor)) {
            if ($this->photo <> null){
                $nombreFotoContactoGenerado = $this->setImage($this->photo, $this->rutaFotosContactos);
                $this->photo = null; 
                $this->iteration++;//BORRA NOMBRE DE ARCHIVO ANTERIOR SELECCIONADO (TRUCO)  
            } 
            else{
                $nombreFotoContactoGenerado = 'noimage.png'; 
            }                
            Proveedor::create([
                'emp_prov' => ucfirst($this->emp_prov),
                'tel_prov'  => ucfirst($this->tel_prov),                       
                'dir_prov' => ucfirst($this->dir_prov),
                'web_prov'  => $this->web_prov,  
                'email_prov' => $this->email_prov,
                'pais_prov'  => ucfirst($this->pais_prov),  
                'prod_prov'  => $this->prod_prov,
                'contacto_prov' => $nombreFotoContactoGenerado
            ]);                                      
            $this->emit('alert',['type'=>'success','message'=>'Registro guardado']);   
            $this->resetVar();              
            $this->emit('HideCreateProveedorModal');            
        } else {            
            $this->emit('msgError', 'Empresa ya existe!');
        }                                  
    }

    public function edit($id)
    {       
        $this->resetValidation(); 
        $proveedor =Proveedor::find($id);    
        $this->ids = $proveedor->id;          
        $this->emp_prov = $proveedor->emp_prov;
        $this->tel_prov = $proveedor->tel_prov;
        $this->dir_prov = $proveedor->dir_prov;
        $this->web_prov = $proveedor->web_prov;
        $this->email_prov = $proveedor->email_prov;
        $this->pais_prov = $proveedor->pais_prov;
        $this->prod_prov = $proveedor->prod_prov; 
        $this->emit('ShowEditProveedorModal');               
    }

    public function update()
    {              
        $this->validate(); 
        if ($this->ids) {            
            $proveedor =Proveedor::find($this->ids);  
            if ($proveedor->emp_prov<>$this->emp_prov) {//SI SE MODIFICO NOMBRE DE EMPRESA                   
                $proveedor = Proveedor::where('emp_prov', '=', ucfirst($this->emp_prov))->first();
                if (empty($proveedor)) {//SI NO EXISTE LA EMPRESA
                    $proveedor =Proveedor::find($this->ids);  
                    if ($this->photo <> null){
                        if($proveedor->contacto_prov <> 'noimage.png'){//SI TENIA FOTO
                            //BORRAR FOTO ANTERIOR Y GENERAR NOMBRE DE NUEVA FOTO      
                            Storage::disk('public')->delete($this->rutaFotosContactos.'/'.$proveedor->contacto_prov);     
                        }    
                        $nombreFotoContactoGenerado = $this->setImage($this->photo, $this->rutaFotosContactos);
                        $this->photo = null; 
                        $this->iteration++;//BORRA NOMBRE DE ARCHIVO ANTERIOR SELECCIONADO (TRUCO)  
                    }
                    else{
                        $nombreFotoContactoGenerado = $proveedor->contacto_prov; 
                    }     
                    $proveedor->update([
                        'emp_prov' => ucfirst($this->emp_prov),
                        'tel_prov'  => ucfirst($this->tel_prov),                       
                        'dir_prov' => ucfirst($this->dir_prov),
                        'web_prov'  => $this->web_prov,  
                        'email_prov' => $this->email_prov,
                        'pais_prov'  => ucfirst($this->pais_prov),  
                        'prod_prov'  => $this->prod_prov,
                        'contacto_prov' => $nombreFotoContactoGenerado
                    ]);                                                                        
                    $this->emit('alert',['type'=>'success','message'=>'Registro actualizado']);                    
                    $this->resetVar();
                    $this->emit('HideEditProveedorModal');
                }
                else{ //SI YA EXISTE LA EMPRESA                   
                    $this->emit('msgError', 'Empresa ya existe!');
                }
                
            } else {//NO SE MODIFICO NOMBRE DE EMPRESA
                if ($this->photo <> null){//SI TENIA FOTO
                    if($proveedor->contacto_prov <> 'noimage.png'){
                        //BORRAR FOTO ANTERIOR Y GENERAR NOMBRE DE NUEVA FOTO      
                        Storage::disk('public')->delete($this->rutaFotosContactos.'/'.$proveedor->contacto_prov);     
                    }    
                    $nombreFotoContactoGenerado = $this->setImage($this->photo, $this->rutaFotosContactos);
                    $this->photo = null; 
                    $this->iteration++;//BORRA NOMBRE DE ARCHIVO ANTERIOR SELECCIONADO (TRUCO)  
                }
                else{
                    $nombreFotoContactoGenerado = $proveedor->contacto_prov; 
                } 
                $proveedor->update([
                    'emp_prov' => ucfirst($this->emp_prov),
                    'tel_prov'  => ucfirst($this->tel_prov),                       
                    'dir_prov' => ucfirst($this->dir_prov),
                    'web_prov'  => $this->web_prov,  
                    'email_prov' => $this->email_prov,
                    'pais_prov'  => ucfirst($this->pais_prov),  
                    'prod_prov'  => $this->prod_prov,
                    'contacto_prov' => $nombreFotoContactoGenerado
                ]);                                                                        
                $this->emit('alert',['type'=>'success','message'=>'Registro actualizado']);                    
                $this->resetVar();
                $this->emit('HideEditProveedorModal');                          
            } //else          
        } //ids               
    }
    
    public function destroy(Proveedor $registro)
    {            
        $registro->delete();
        //SI EL REGISTRO TIENE FOTO SE ELIMINA LA IMAGEN
        if ($registro->contacto_prov <> 'noimage.png'){
            Storage::disk('public')->delete($this->rutaFotosContactos.'/'.$registro->contacto_prov); 
        }    
    }   
}
