<?php

namespace App\Http\Livewire\CrearSubnormal;

use App\Mail\NotificacionCreacionSubnormal;
use App\Models\Controlterreno;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificacionMacromedidor;
use App\Models\CrearSubnormal;
use App\Models\municipalities;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;


class Create extends Component
{
    use WithFileUploads;

   public $sector_name;
   public $control_terrenos_id;
   public $phone;
   public $address;
   public $invoice_code='';
   public $file_name_alcaldia_document='';
   public $file_name_actalider_document='';
   public $slugifiedFilename_actaemsa_document='';

   public $Usuarios;
   public $controlterreno;

   public $creacionZona;
   public $municipily;

   public $municipios_zone_id;




    //User login
    public $loggedUser;
    public $loggedUserRole;
    protected $listeners = [
        'SectorsubmuniciplesChange'
    ];
    protected function rules(){
        $rules= [

            'sector_name'=>'required',
            'control_terrenos_id'=>'required',

            'phone'=>'required',
            'address'=>'required'


//            'league_id'=>'required'
        ];

        return $rules;
    }
    protected $messages = [

        'sector_name.required'=>'Sector Name field is required',
        'control_terrenos_id.required'=>'Select an option',

        'phone.required'=>'phone field is required',
        'address.required'=>'address field is required'


    ];
    public function hydrate(){
        $this->emit('sectorsubnormalCreatemunicfdfiplesHydrate');
    }
    public function SectorsubmuniciplesChange($value, $key){
        $this->$key = $value;
    }
    public function closeAndClean(){
        $this->reset([

            'sector_name',
            'control_terrenos_id',

            'phone',
            'address'


        ]);
        $this->resetValidation([

            'sector_name',
            'control_terrenos_id',

            'phone',
            'address'

        ]);
    }
     public function mount(){
         $this->Usuarios = User::all();
         //$this->datacaminante = Datoscaminante::all();
         $this->loggedUser = Auth::user();
         $this->loggedUserRole = $this->loggedUser->getRoleNames()->first();
         $this->municipily=municipalities::all();

          // Filtrar los datos del caminante para excluir los ya seleccionados
        $selectedDataIds = CrearSubnormal::pluck('control_terrenos_id')->toArray();
        $this->controlterreno = Controlterreno::whereNotIn('id', $selectedDataIds)->get();
     }
    public function save()
    {
        $this->validate();


        $existingRecord = CrearSubnormal::where('control_terrenos_id', $this->control_terrenos_id)->exists();
        if($existingRecord) {
            // Lógica de manejo de error o advertencia si el registro ya existe
            // Por ejemplo:
            $this->addError('control_terrenos_id', 'This data has already been selected');
            return;
        }

        $creacionZona = new CrearSubnormal();
        $creacionZona->sector_name = $this->sector_name;

        $creacionZona->phone = $this->phone;
        $creacionZona->address = $this->address;

        $creacionZona->control_terrenos_id = $this->control_terrenos_id;

        $creacionZona->municipios_zone_id = $this->municipios_zone_id;

        $creacionZona->save();

        // Obtener usuarios con el rol 'Centro de Inteligencia'
        $usuariosCentroInteligencia = User::role('Centro de Inteligencia')->get();

        // Verificar si hay usuarios con el rol 'Centro de Inteligencia' y enviar correos
        if ($usuariosCentroInteligencia->isNotEmpty()) {
            foreach ($usuariosCentroInteligencia as $usuario) {
                Mail::to($usuario->email)->send(new NotificacionCreacionSubnormal($creacionZona));
            }
        } else {
            // Mostrar una alerta de que no se encontraron usuarios con el rol 'Centro de Inteligencia'
            echo '<script>alert("El Correo no es una cuenta existente para el rol Centro de Inteligencia");</script>';
        }


         // Obtener usuarios con el rol 'Admin'
         $usuariosAdmin = User::role('Admin')->get();

           // Verificar si hay usuarios con el rol 'Admin' y enviar correos
        if ($usuariosAdmin->isNotEmpty()) {
            foreach ($usuariosAdmin as $usuario) {
                Mail::to($usuario->email)->send(new NotificacionCreacionSubnormal($creacionZona));
            }
        } else {
            // Mostrar una alerta de que no se encontraron usuarios con el rol 'Centro de Inteligencia'
            echo '<script>alert("El Correo no es una cuenta existente para el rol Admin");</script>';
        }



        // Obtener usuarios con el rol 'Grupo Social'
        $usuariosGrupoSocial = User::role('Grupo Social')->get();

            // Verificar si hay usuarios con el rol 'Admin' y enviar correos
                if ($usuariosGrupoSocial->isNotEmpty()) {
                    foreach ($usuariosGrupoSocial as $usuario) {
                        Mail::to($usuario->email)->send(new NotificacionCreacionSubnormal($creacionZona));
                    }
                } else {
                    // Mostrar una alerta de que no se encontraron usuarios con el rol 'Centro de Inteligencia'
                    echo '<script>alert("El Correo no es una cuenta existente para el rol Grupo Social");</script>';
                }


        $this->emitTo('crear.subnormal.show','render');
        $this->emit('alert',__('Registered Zone SubNormal!'),'#create');
        $this->emit('CourtsShowRender');
        $this->closeAndClean();

        return redirect()->route('CrearSubNormal.index');
    }

    public function render()
    {
        return view('livewire.crear-subnormal.create');
    }
}


