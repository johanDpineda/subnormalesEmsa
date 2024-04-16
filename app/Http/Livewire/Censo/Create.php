<?php

namespace App\Http\Livewire\Censo;


use App\Models\Censo;
use App\Models\Controlterreno;
use App\Models\User;


use App\Models\CrearSubnormal;
use App\Models\municipalities;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;


class Create extends Component
{
    use WithFileUploads;


   public $cedula_lider;
   public $area;
   public $fecha_censo;
   public $zona_subnormal_id;
   public $municipalities_id;



   public $Usuarios;
   public $controlterreno;
    public $municipios;
   public $creacionZona;




    //User login
    public $loggedUser;
    public $loggedUserRole;
    protected $listeners = [
        'sectorsubnormalCreateChange'
    ];
    protected function rules(){
        $rules= [

            'municipalities_id'=>'required',
            'zona_subnormal_id'=>'required',
            'cedula_lider'=>'required|unique:censo|',
            'area'=>'required',
            'fecha_censo'=>'required',



//            'league_id'=>'required'
        ];

        return $rules;
    }
    protected $messages = [

        'municipalities_id.required'=>'select a municipality',
        'zona_subnormal_id.required'=>'Select a Subnormal zone',
        'cedula_lider.required'=>'The leaders ID is mandatory',
        'area.required'=>'Select a Subnormal zone',
        'fecha_censo.required'=>'census date is required',


    ];
    public function hydrate(){
        $this->emit('sectorsubnormalCreateHydrate');
    }
    public function sectorsubnormalCreateChange($value, $key){
        $this->$key = $value;
    }
    public function closeAndClean(){
        $this->reset([

            'cedula_lider',
            'area',
            'fecha_censo',

            'municipalities_id',
            'zona_subnormal_id'


        ]);
        $this->resetValidation([

            'cedula_lider',
            'area',
            'fecha_censo',

            'municipalities_id',
            'zona_subnormal_id'

        ]);
    }
     public function mount(){
         $this->Usuarios = User::all();
         //$this->datacaminante = Datoscaminante::all();
         $this->loggedUser = Auth::user();
         $this->loggedUserRole = $this->loggedUser->getRoleNames()->first();

         $this->municipios=municipalities::all();


          // Filtrar los datos del caminante para excluir los ya seleccionados
        $selectedDataIds = Censo::pluck('zona_subnormal_id')->toArray();
        $this->controlterreno = CrearSubnormal::whereNotIn('id', $selectedDataIds)->get();
     }
    public function save()
    {
        $this->validate();

        $censofamilias = new Censo();

        $censofamilias->cedula_lider = $this->cedula_lider;
        $censofamilias->area = $this->area;
        $censofamilias->fecha_censo = $this->fecha_censo;
        $censofamilias->municipalities_id = $this->municipalities_id;
        $censofamilias->zona_subnormal_id = $this->zona_subnormal_id;

        $censofamilias->save();







        $this->emitTo('crear.subnormal.show','render');
        $this->emit('alert',__('Registered Zone SubNormal!'),'#create');
        $this->emit('CourtsShowRender');
        $this->closeAndClean();

        return redirect()->route('censofamilia.index');
    }

    public function render()
    {
        return view('livewire.censo.create');
    }
}


