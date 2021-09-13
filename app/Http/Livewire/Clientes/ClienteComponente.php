<?php

namespace App\Http\Livewire\Clientes;

use Livewire\Component;

use App\Models\Cliente;   
use Livewire\WithPagination;

use Carbon\Carbon;

class ClienteComponente extends Component
{

    //CAMPOS DE FORMULARIO CLIENTE
    public $nom_cli, $doc_cli, $tel_cli, $ciudad_cli='La Paz', $pref_cli;
     //VARIABLES GLOBAL 
     public $ids;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';


    protected $listeners = ['destroy'];
    //REGLAS DE VALIDACION DE FORMULARIO
    protected $rules = [   
        'nom_cli'  => 'required',                       
        'doc_cli'  => 'required',                 
        'tel_cli'  => 'required',           
        'ciudad_cli'  => 'required'
    ];

    public function render()
    {
        return view('livewire.clientes.cliente-componente',[
            'clientes' => Cliente::paginate(10)
        ]);
    }

    public function resetVar()
    {
        $this->reset(['nom_cli', 'doc_cli', 'tel_cli', 'pref_cli']);     
    }

    public function store()
    {
        $this->validate();
        Cliente::create([
            'nom_cli' => $this->nom_cli,               
            'doc_cli' => $this->doc_cli,                      
            'tel_cli' => $this->tel_cli,               
            'ciudad_cli' => $this->ciudad_cli,
            'pref_cli' => $this->pref_cli,              
        ]);
        $this->emit('alert',['type'=>'success','message'=>'Registro guardado']);
        $this->resetVar();  
        $this->emit('HideCreateClienteModal');
    }

    public function destroy(Cliente $registro){                     
        $registro->delete();                      
    }  

    public function edit($id){         
        $this->resetValidation();             
        $cliente = Cliente::find($id); 
        $this->ids = $cliente->id;  
        
        $this->nom_cli = $cliente->nom_cli;                
        $this->doc_cli = $cliente->doc_cli;
        $this->tel_cli = $cliente->tel_cli;
        $this->ciudad_cli = $cliente->ciudad_cli;        
        $this->pref_cli = $cliente->pref_cli;
        $this->emit('ShowEditClienteModal');  
    }

    public function update(){                     
        if ($this->ids) {            
            $cliente =Cliente::find($this->ids);
        }
        
        $cliente->nom_cli = $this->nom_cli;
        $cliente->doc_cli = $this->doc_cli;
        $cliente->tel_cli = $this->tel_cli;
        $cliente->ciudad_cli = $this->ciudad_cli;
        $cliente->pref_cli = $this->pref_cli;

        if($cliente->isDirty()){                        
            $cliente->save();
            $this->emit('alert',['type'=>'success','message'=>'Registro actualizado']); 
        }
        else
        {
            $this->emit('alert',['type'=>'info','message'=>'Nada para actualizar']); 
        }       
        
        $this->emit('HideEditClienteModal');
    }  
}
