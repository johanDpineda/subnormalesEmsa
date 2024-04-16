<?php

namespace App\Http\Livewire\Datoscaminante;

use App\Models\Datoscaminante;
use App\Models\NetworkStatus;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificacionTerrenoSubNormal;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;


class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $latitude_mirror;
    public $longitude_mirror;
    public $Usuarios;
    public $Cantidad_transformador;
    public $Cantidad_usuario;
    public $Observaciones;
    public $network_status_id;
    public $NetworkStatus;


    //User login
    public $loggedUser;
    public $loggedUserRole;
    protected $listeners = [
        'datacaminanteCreateChange'
    ];
    protected function rules(){
        $rules= [

            'name'=>'required',
            'latitude_mirror' => 'required|numeric',
            'longitude_mirror' => 'required|numeric',
            'Cantidad_transformador'=>'required',
            'Cantidad_usuario'=>'required',
            'Observaciones'=>'required',
            'network_status_id'=>'required',

        ];

        return $rules;
    }
    protected $messages = [

        'name.required'=>'Name field is required',
        'latitude_mirror.required'=>'Latitude field is required',
        'longitude_mirror.required'=>'Longitude field is required',
        'latitude_mirror.numeric' => 'El campo latitud debe ser un número decimal válido',
        'longitude_mirror.numeric' => 'El campo longitud debe ser un número decimal válido',
        'Cantidad_transformador.required'=>'Enter the quantity of the transformers',
        'Cantidad_usuario.required'=>'Enter the number of people',
        'Observaciones.required'=>'observation field is required',
        'network_status_id.required'=>'Select network status',

    ];
    public function hydrate(){
        $this->emit('datacaminanteCreateHydrate');
    }
    public function datacaminanteCreateChange($value, $key){
        $this->$key = $value;
    }
    public function closeAndClean(){
        $this->reset([

            'name',
            'latitude_mirror',
            'longitude_mirror',
            'Cantidad_transformador',
            'Cantidad_usuario',
            'Observaciones',
            'network_status_id',



        ]);
        $this->resetValidation([

            'name',
            'latitude_mirror',
            'longitude_mirror',
            'Cantidad_transformador',
            'Cantidad_usuario',
            'Observaciones',
            'network_status_id'
        ]);
    }
     public function mount(){
         $this->Usuarios = User::all();
         $this->NetworkStatus = NetworkStatus::all();
         $this->loggedUser = Auth::user();
         $this->loggedUserRole = $this->loggedUser->getRoleNames()->first();
     }
    public function save(){
        $this->validate();

        $datoscaminante_nuevos = new Datoscaminante();
        $datoscaminante_nuevos->name = $this->name;
        $datoscaminante_nuevos->slug = Str::slug($this->name);
        $datoscaminante_nuevos->latitude = $this->latitude_mirror;
        $datoscaminante_nuevos->longitude = $this->longitude_mirror;
        $datoscaminante_nuevos->Cantidad_transformador = $this->Cantidad_transformador;
        $datoscaminante_nuevos->Cantidad_usuario = $this->Cantidad_usuario;
        $datoscaminante_nuevos->Observaciones = $this->Observaciones;
        $datoscaminante_nuevos->network_status_id = $this->network_status_id;

        // Obtener el ID del rol del usuario logueado
        $role_id = Auth::user()->id;

        // Asignar el ID del rol al modelo Datoscaminante
        $datoscaminante_nuevos->role_id = $role_id;

        $datoscaminante_nuevos->save();

            // Envío de correo electrónico
        try {
            $usuarioscentrointeligencia = User::role('Centro de Inteligencia')->get();
            foreach ($usuarioscentrointeligencia as $usuario) {
                Mail::to($usuario->email)->send(new NotificacionTerrenoSubNormal($datoscaminante_nuevos));
            }
        } catch (\Exception $e) {
            // Manejar el error de envío de correo electrónico
            \Log::error('Error al enviar el correo electrónico: ' . $e->getMessage());
            // Aquí puedes agregar cualquier otra acción que desees realizar cuando falla el envío del correo electrónico
        }


        $this->emitTo('datoscaminante.show','render');
        $this->emit('alert',__('Registered zone!'),'#create');
        $this->emit('CourtsShowRender');
        $this->closeAndClean();
        return redirect()->route('Caminantes.index');

    }

    public function render()
    {
        return view('livewire.datoscaminante.create');
    }
}
