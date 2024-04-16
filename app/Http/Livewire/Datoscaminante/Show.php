<?php

namespace App\Http\Livewire\Datoscaminante;


use App\Models\Datoscaminante;

use App\Models\NetworkStatus;
use App\Models\User;

use Illuminate\Support\Facades\Mail;
use App\Mail\ActualizacionTerrenoSubnormal;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\Datacaminante;

class Show extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $listeners = [
        'walkerShowChange',
        'walkerShowRender'=>'render'
    ];

    public function hydrate(){
        $this->emit('walkerShowHydrate');
    }

    public $readyToLoad = false;
    public $maintenance = false;
    public $walking;
    public $Walker_id;
    public $networkstatuss;
    public $networkstatuss_id;
    public $caminantes;
    public $query = '';
    public $cant = '10';
    protected $queryString = [
        'cant'=> ['except'=>'10'],
        'query'=> ['except'=>'']
    ];
    //User login
    public $loggedUser;
    public $loggedUserRole;

    public function updatingQuery()
    {
        $this->resetPage();
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
            $caminante = $this->chargingData();
        }else{
            $caminante = [];
        }
        return view('livewire.datoscaminante.show',compact('caminante'));
    }
    public function closeAndClean()
    {
        $this->reset([

            'openMapModal',
            'openMapModalobservaciones'


        ]);

        $this->resetValidation([

            'openMapModal',
            'openMapModalobservaciones'

        ]);
    }


    public function exportarExcel()
    {

        // Exportar los datos a un archivo Excel
        return Excel::download(new Datacaminante, 'datos_caminante.xlsx');
    }


    public function chargingData()
    {
        $user = Auth::user();

        // Inicializa una consulta para Datoscaminante
        $query = Datoscaminante::query();

        // Filtrar Datoscaminante basado en el rol del usuario autenticado
        if ($this->loggedUserRole == 'Centro de Inteligencia' || $this->loggedUserRole == 'Admin') {
            // Si el usuario tiene el rol de "Centro de Inteligencia" o "Admin", continuar con la consulta actual
            if ($this->query) {
                $query->where('name', 'like', '%' . $this->query . '%');
            }
        } else {
            // Si no, filtrar por el role_id del usuario autenticado
            $query->where('role_id', $user->id);
            if ($this->query) {
                $query->where('name', 'like', '%' . $this->query . '%');
            }
        }

        // Filtrar usuarios basados en Walker_id si está presente
        if ($this->Walker_id) {
            $query->whereHas('user', function ($subquery) {
                $subquery->where('role_id', $this->Walker_id);
            });
            $this->resetPage();



        }

        // Filtrar usuarios basados en networkstatuss_id si está presente
        if ($this->networkstatuss_id) {
            $query->where('role_id', $this->networkstatuss_id);
            $this->resetPage();
        }

        // Aplica la paginación a la consulta
        $caminantes = $query->paginate($this->cant);

        return $caminantes;
    }

    public function resetFilter(){
        $this->reset(['Walker_id','networkstatuss_id']);
    }





    //Edit
    public $User;
    public $datoscaminante;
    public $datoscaminantemapas;
    public $openMapModal;
    public $openMapModalobservaciones;


    public $name;
    public $latitude_mirror_edit;
    public $longitude_mirror_edit;

    public $Cantidad_transformador;
    public $Cantidad_usuario;
    public $Observaciones;
    public $network_status_id;
    public $NetworkStatus;







    protected function rules(){
        return [
            'image'=>'',
            'court.name'=>'',
            'court.address'=>'',
            'court.league_id'=>'',
            'court.is_active'=>''
        ];
    }
    public function mount()
    {
        $this->User = User::all();
        $this->NetworkStatus = NetworkStatus::all();
        $this->loggedUser = Auth::user();
        $this->loggedUserRole = $this->loggedUser->getRoleNames()->first();

        if ($this->loggedUserRole == 'Admin' || $this->loggedUserRole == 'Centro de Inteligencia') {
            // Obtener los IDs de los usuarios que hayan registrado información en la tabla data_caminante
            $userIdsWithCaminanteData = Datoscaminante::distinct()->pluck('role_id');

            // Filtrar datos de caminantes basados en los IDs de los usuarios obtenidos
            $this->walking = User::whereIn('id', $userIdsWithCaminanteData)->get();
        }



         // Filtrar los datos solo si el usuario tiene el rol "Admin" o "Centro de Inteligencia"
         if ($this->loggedUserRole == 'Admin' || $this->loggedUserRole == 'Centro de Inteligencia') {
            // Filtrar usuarios con el rol "caminante"
            $this->networkstatuss = NetworkStatus::all();
        }







    }
    public function edit(Datoscaminante $datoscaminante){
        $this->datoscaminante = $datoscaminante;
        $this->name = $this->datoscaminante->name;
        $this->latitude_mirror_edit = $this->datoscaminante->latitude;
        $this->longitude_mirror_edit = $this->datoscaminante->longitude;
        $this->Cantidad_transformador = $this->datoscaminante->Cantidad_transformador;
        $this->Cantidad_usuario = $this->datoscaminante->Cantidad_usuario;
        $this->Observaciones = $this->datoscaminante->Observaciones;
        $this->network_status_id = $this->datoscaminante->network_status_id;
    }
    public function maps(Datoscaminante $datoscaminantemapas){
        $this->datoscaminantemapas = $datoscaminantemapas;
        $this->name = $this->datoscaminantemapas->name;
        $this->latitude_mirror_edit = $this->datoscaminantemapas->latitude;
        $this->longitude_mirror_edit = $this->datoscaminantemapas->longitude;
        $this->Cantidad_transformador = $this->datoscaminantemapas->Cantidad_transformador;
        $this->Cantidad_usuario = $this->datoscaminantemapas->Cantidad_usuario;
        $this->Observaciones = $this->datoscaminantemapas->Observaciones;
        $this->network_status_id = $this->datoscaminantemapas->network_status_id;
    }
    public function update()
    {

        if ($this->name){
            $this->datoscaminante->name = $this->name;
        }

        if ($this->latitude_mirror_edit){
            $this->datoscaminante->latitude = $this->latitude_mirror_edit;
        }

        if ($this->longitude_mirror_edit){
            $this->datoscaminante->longitude = $this->longitude_mirror_edit;
        }

        if ($this->Cantidad_transformador){
            $this->datoscaminante->Cantidad_transformador = $this->Cantidad_transformador;
        }


        if ($this->Cantidad_usuario){
            $this->datoscaminante->Cantidad_usuario = $this->Cantidad_usuario;
        }

        if ($this->Observaciones){
            $this->datoscaminante->Observaciones = $this->Observaciones;
        }

        if ($this->network_status_id){
            $this->datoscaminante->network_status_id = $this->network_status_id;
        }


        $this->datoscaminante->save();

               // Envío de correo electrónico
               try {
                $usuarioscentrointeligencia = User::role('Centro de Inteligencia')->get();
                foreach ($usuarioscentrointeligencia as $usuario) {
                    Mail::to($usuario->email)->send(new ActualizacionTerrenoSubnormal($this->datoscaminante));
                }
            } catch (\Exception $e) {
                // Manejar el error de envío de correo electrónico
                \Log::error('Error al enviar el correo electrónico: ' . $e->getMessage());
                // Aquí puedes agregar cualquier otra acción que desees realizar cuando falla el envío del correo electrónico
            }



        $this->emitTo('Datoscaminante.show','render');
        $this->emit('alert',__('Updated court!'),'#edit');
        $this->emit('walkerShowRender');

        $this->closeAndClean();
    }



    public $selectedCaminante;

    public function openMapModal($caminanteId)
    {
        $this->selectedCaminante = Datoscaminante::findOrFail($caminanteId);
        $this->emit('openMapModal');
        $this->closeAndClean();

    }

    public $selectedCaminanteobservaciones;

    public function openMapModalobservaciones($caminanteId)
    {
        $this->selectedCaminanteobservaciones = Datoscaminante::findOrFail($caminanteId);
        $this->emit('openMapModalobservaciones');
        $this->closeAndClean();

    }
}
