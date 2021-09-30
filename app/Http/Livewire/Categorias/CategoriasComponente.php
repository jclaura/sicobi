<?php

namespace App\Http\Livewire\Categorias;

use Livewire\Component;

//ADICIONADO
use App\Models\Categoria;   
use Livewire\WithPagination;  


class CategoriasComponente extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    //VARIABLES DE FORMULARO COINCIDENTE CON LA TABLA CATEGORIA
    public $cat_desc, $cat_cod; 
    
    //VARIABLES GLOBAL 
    public $ids;

    protected $listeners = ['destroy'];
    

    public function render()
    {
        return view('livewire.categorias.categorias-componente',[
            'categorias' => Categoria::paginate(12)
        ]);
    } 

    //REGLAS DE VALIDACION DE FORMULARIO
    protected $rules = [                
        'cat_desc'   => 'required|min:6|max:50|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',       
        'cat_cod'=>'required|alpha|min:2|max:2'         
    ];

    protected $messages = [
        'cat_desc.required' => 'Descripción requerido',             
        'cat_desc.min' => 'Descripción debe contener mínimo 6 caracteres',
        'cat_desc.max' => 'Descripción debe contener máximo 50 caracteres',
        'cat_cod.required' => 'Código requerido',
        'cat_cod.alpha' => 'Código debe contener solo caracteres',
        'cat_cod.min' => 'Código debe contener mínimo 2 caracteres',            
        'cat_cod.max' => 'Código debe contener máximo 2 caracteres'  
    ];
    
    public function resetVar(){
        $this->reset(['cat_desc','cat_cod']);
    }

    public function store()
    {
        $this->validate();
        $categoria = Categoria::where('cat_cod', '=', strtoupper($this->cat_cod))->first();               
        if (empty($categoria)) {
            Categoria::create([
                'cat_desc' => ucfirst($this->cat_desc),
                'cat_cod'  => strtoupper($this->cat_cod)                       
            ]);
            $this->emit('alert',['type'=>'success','message'=>'Registro guardado']);   
            $this->reset(['cat_desc','cat_cod']);  
            $this->emit('HideCreateCategoriaModal');
        } else {            
            $this->emit('msgError', 'Código ya existe!');
        }                    
    }

    public function edit($id)
    {
        $categoria =Categoria::find($id);    
        $this->ids = $categoria->id;

        $this->cat_desc = $categoria->cat_desc;
        $this->cat_cod = $categoria->cat_cod;
        $this->emit('ShowEditCategoriaModal');
    }
    public function update()
    {              
        $this->validate(); 
        if ($this->ids) {
            $categoria =Categoria::find($this->ids);  
            if ($categoria->cat_cod<>$this->cat_cod) {                
                $categoria = Categoria::where('cat_cod', '=', strtoupper($this->cat_cod))->first();
                if (empty($categoria)) {
                    $categoria =Categoria::find($this->ids);  
                    $categoria->update([
                        'cat_desc' => ucfirst($this->cat_desc),
                        'cat_cod' => strtoupper($this->cat_cod)
                    ]); 
                    $this->emit('alert',['type'=>'success','message'=>'Registro actualizado']);
                    $this->reset(['cat_desc','cat_cod']);
                    $this->emit('HideEditCategoriaModal');
                }
                else{
                    $this->emit('msgError', 'Código ya existe!');
                }
                
            } else {
                $categoria->update([
                    'cat_desc' => ucfirst($this->cat_desc),
                    'cat_cod' => strtoupper($this->cat_cod)
                ]); 
                $this->emit('alert',['type'=>'success','message'=>'Registro actualizado']);
                $this->reset(['cat_desc','cat_cod']);
                $this->emit('HideEditCategoriaModal');                
            }           
        }               
    }

    public function destroy(Categoria $registro)
    {
        $registro->delete();
    }    
}
