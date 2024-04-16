<?php

namespace App\Http\Livewire\ControlTerrenos;


use App\Models\Controlterreno;
use App\Models\Datoscaminante;

use Illuminate\Support\Facades\Mail;
use App\Mail\ActualizacionMacromedidor;

use App\Models\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Exports\Codemacro;
use Maatwebsite\Excel\Facades\Excel;

class Show extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $listeners = [
        'walkerShowChange',
        'walkerShowRender'=>'render'
    ];
    public $readyToLoad = false;
    public $maintenance = false;
    public $openMapModal;
    public $openMapModalobservaciones;
    public $user;
    public $query = '';
    public $cant = '10';
    protected $queryString = [
        'cant'=> ['except'=>'10'],
        'query'=> ['except'=>'']
    ];
    //User login
    public $loggedUser;
    public $loggedUserRole;

    protected function rules(){
        $rules= [

            'code_macromedidor' => ['required', 'max:20', Rule::unique('control_terrenos')->where(function ($query) {
                return $query->where('code_macromedidor', $this->code_macromedidor);
            })],

        ];

        return $rules;
    }
    protected $messages = [

        'code_macromedidor.required'=>'Macro Meter Code field is required',
        'code_macromedidor.unique'=>'code macromedidor already exists',
        'code_macromedidor.max'=>'macrometric code field allows only 20 characters',


    ];

    public function exportarExcel()
    {

        // Exportar los datos a un archivo Excel
        return Excel::download(new Codemacro, 'Datos_MacromedidorSubnormales.xlsx');
    }

    public function updatingQuery()
    {
        $this->resetPage();
    }
    public function hydrate(){
        $this->emit('walkerShowHydrate');
    }
    public function walkerShowChange($value, $key)
    {
        $this->$key = $value;
    }
    public function readyToLoad()
    {
        $this->readyToLoad = true;
    }
    public function render()
    {
        if ($this->readyToLoad){
            $terreno = $this->chargingData();
        }else{
            $terreno = [];
        }
        return view('livewire.control-terrenos.show',compact('terreno'));
    }
    public function resetFilter(){
        $this->reset(['Walkercam_id']);
    }
    public function chargingData()
    {


        $query = Controlterreno::query();

        // Filtrar por el código del macro medidor si está presente
        if ($this->query) {
            $query->where('code_macromedidor', 'like', '%' . $this->query . '%');
        }

         // Filtrar por el ID del caminante seleccionado
        if ($this->Walkercam_id) {
            $query->whereHas('Datoscaminante', function ($subquery) {
                $subquery->where('role_id', $this->Walkercam_id);
            });
            $this->resetPage();
        }

        // Paginar el resultado
        $terreno = $query->paginate($this->cant);

        return $terreno;
    }

    public function closeAndClean()
    {
        $this->reset([

            'openMapModal',



        ]);

        $this->resetValidation([

            'openMapModal',


        ]);
    }






    //Edit

    public $control_terreno;
    public $code_macromedidor;


    public $User;

    public $walking;
    public $Walkercam_id;



    public function mount()
    {
        $this->User = User::all();

        $this->loggedUser = Auth::user();
        $this->loggedUserRole = $this->loggedUser->getRoleNames()->first();

        // Filtrar los datos solo si el usuario tiene el rol "Admin" o "Centro de Inteligencia"
        if ($this->loggedUserRole == 'Admin' || $this->loggedUserRole == 'Centro de Inteligencia') {
              // Obtener los IDs de los usuarios que hayan registrado información en la tabla data_caminante
              $userIdsWithCaminanteData = Datoscaminante::distinct()->pluck('role_id');

              // Filtrar datos de caminantes basados en los IDs de los usuarios obtenidos
              $this->walking = User::whereIn('id', $userIdsWithCaminanteData)->get();
        }
    }
    public function edit(Controlterreno $control_terreno){
        $this->control_terreno = $control_terreno;
        $this->code_macromedidor = $this->control_terreno->code_macromedidor;



    }
    public function update()
    {
        $this->validate();

        if ($this->code_macromedidor){
            $this->control_terreno->code_macromedidor = $this->code_macromedidor;
        }




        $this->control_terreno->save();
          // Envío de correo electrónico
          $usuariosGrupoSocial = User::role('Grupo Social')->get();
          foreach ($usuariosGrupoSocial as $usuario) {
              Mail::to($usuario->email)->send(new ActualizacionMacromedidor($this->control_terreno));
          }
        $this->emitTo('control-terrenos.show','render');
        $this->emit('alert',__('Updated macro meter code'),'#edit');
        $this->emit('walkerShowRender');

    }


    public $selectedCaminante;

    public function openMapModal($caminanteId)
    {
        $this->selectedCaminante = Controlterreno::findOrFail($caminanteId);
        $this->emit('openMapModal');
        $this->closeAndClean();

    }

    public $selectedCaminanteobservaciones;

    public function openMapModalobservaciones($caminanteId)
    {
        $this->selectedCaminanteobservaciones = Controlterreno::findOrFail($caminanteId);
        $this->emit('openMapModalobservaciones');
        $this->closeAndClean();

    }

    public $controlterrenos_codemacro;






}
