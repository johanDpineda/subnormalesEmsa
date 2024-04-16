<?php

namespace App\Http\Livewire\ControlTerrenos;

use App\Models\Controlterreno;
use App\Models\Datoscaminante;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificacionMacromedidor;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;


class Create extends Component
{
    use WithFileUploads;

    public $code_macromedidor;
    public $latitude_mirror;
    public $longitude_mirror;
    public $Usuarios;
    public $Cantidad_transformador;
    public $Cantidad_usuario;
    public $Observaciones;
    public $data_caminante_id;

    public $datacaminante;


    //User login
    public $loggedUser;
    public $loggedUserRole;
    protected $listeners = [
        'ControlterrenoCreateChange'
    ];
    protected function rules(){
        $rules= [

            'code_macromedidor' => ['required', 'max:20', Rule::unique('control_terrenos')->where(function ($query) {
                return $query->where('code_macromedidor', $this->code_macromedidor);
            })],
            'data_caminante_id'=>'required',

        ];

        return $rules;
    }
    protected $messages = [

        'code_macromedidor.required'=>'Macro Meter Code field is required',
        'code_macromedidor.unique'=>'code macromedidor already exists',
        'code_macromedidor.max'=>'macrometric code field allows only 20 characters',

        'data_caminante_id.required'=>'Select an option'
    ];
    public function hydrate(){
        $this->emit('controlterrenoCreateHydrate');
    }
    public function ControlterrenoCreateChange($value, $key){
        $this->$key = $value;
    }
    public function closeAndClean(){
        $this->reset([

            'code_macromedidor',
            'data_caminante_id'


        ]);
        $this->resetValidation([

            'code_macromedidor',
            'data_caminante_id'


        ]);
    }
     public function mount(){
         $this->Usuarios = User::all();
         //$this->datacaminante = Datoscaminante::all();
         $this->loggedUser = Auth::user();
         $this->loggedUserRole = $this->loggedUser->getRoleNames()->first();

          // Filtrar los datos del caminante para excluir los ya seleccionados
        $selectedDataIds = Controlterreno::pluck('data_caminante_id')->toArray();
        $this->datacaminante = Datoscaminante::whereNotIn('id', $selectedDataIds)->get();
     }
    public function save(){
        $this->validate();

        $existingRecord = Controlterreno::where('data_caminante_id', $this->data_caminante_id)->exists();
        if($existingRecord) {
            // Lógica de manejo de error o advertencia si el registro ya existe
            // Por ejemplo:
            $this->addError('data_caminante_id', 'This data has already been selected');
            return;
        }

        $datoscaminante = new Controlterreno();
        $datoscaminante->code_macromedidor = $this->code_macromedidor;
        $datoscaminante->data_caminante_id = $this->data_caminante_id;



        $datoscaminante->save();



        try {
            // Envío de correo electrónico
            $usuariosGrupoSocial = User::role('Grupo Social')->get();
            foreach ($usuariosGrupoSocial as $usuario) {
                Mail::to($usuario->email)->send(new NotificacionMacromedidor($datoscaminante));
            }
        } catch (\Exception $e) {
            // Manejar el error de envío de correo electrónico
            \Log::error('Error al enviar el correo electrónico: ' . $e->getMessage());
            // Aquí puedes agregar cualquier otra acción que desees realizar cuando falla el envío del correo electrónico
        }


        $this->emitTo('control-terrenos.show','render');
        $this->emit('alert',__('Registered Macrometer!'),'#create');
        $this->emit('CourtsShowRender');
        $this->closeAndClean();

        return redirect()->route('controlTerrenos.index');

    }

    public function render()
    {
        return view('livewire.control-terrenos.create');
    }
}

