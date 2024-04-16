<?php

namespace App\Http\Livewire\CrearSubnormal;

use App\Exports\zonesubnormal;
use App\Mail\NotificacioncodeTesoreria;
use App\Mail\NotificacionTesoreria;
use App\Models\CrearSubnormal;
use App\Models\DocumentsAcuerdoemsa;
use App\Models\Documentsalcaldias;
use App\Models\DocumentsLider;
use App\Models\municipalities;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB; // Asegúrate de importar la clase DB si no está ya importada
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class Show extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $certificadoCargado = false;
    public $actaCargada = false;
    public $acuerdoCargado = false;
    public $offcanvasEnd=false;

    public $documents_about_to_expire = [];
    public $showDocumentInfo = false; // Nueva propiedad para controlar la visualización de la información en el offcanvas



    //Edit

    public $creacionZona;


    public $creacionZonads;

    public $creacionsubnormals;

    public $zona_subnormal_id;

    //llamados las funciones del componente para la subi de los documentos a sus respectivas tablas de la BD
    public $cargarCertificado;
    public $cargarActa;
    public $cargarAcuerdo;

    public $crear_certificado_id;

    //llamados las variables el cual abre el modal para la subida de los documentos
    public $docAlcaldiaa;
    public $doclideer;
    public $docacuerdoemsaa;

    public $codefactura;




    public $code_macromedidor;

    public $file_name_alcaldia;
    public $file_name_actalider;
    public $file_name_acuerdoemsa;


    public $crear_certificado;
    public $crear_acta;
    public $crear_acuerdo;

    public $creatingCertificate ;
    public $creatingActa ;
    public $creatingAcuerdoEMSA;
    public $editar_subnormal;
    public $listdocuments;
    public $municipios_zone_id;



    public $User;


    public $sector_name;
    public $phone;
    public $address;
    public $invoice_code='';
    public $listadoDocumento;
    public $start_date;
    public $documentsToExpire;

    public $alerts;

    public $municipily;






    protected $listeners = [
        'sectorsubnormalCreateChangeedit'
    ];

    public $readyToLoad = false;
    public $maintenance = false;
    public $query = '';
    public $cant = '10';
    protected $queryString = [
        'cant' => ['except' => '10'],
        'query' => ['except' => '']
    ];

    public function hydrate(){
        $this->emit('sectorsubnormalCreateHydrateedit');
    }
    public function sectorsubnormalCreateChangeedit($value, $key){
        $this->$key = $value;
    }

    public $loggedUser;
    public $loggedUserRole;


    public function updatingQuery()
    {
        $this->resetPage();
    }

    public function CourtsShowChange($value, $key)
    {
        $this->$key = $value;
    }

    public function readyToLoad()
    {
        $this->readyToLoad = true;
    }

    public function exportarExcel()
    {

        // Exportar los datos a un archivo Excel
        return Excel::download(new zonesubnormal, 'Acuerdo_ZonasSubnormales.xlsx');
    }

    public function closeAndClean()
    {
        $this->reset([
            'file_name_alcaldia',
            'file_name_actalider',
            'file_name_acuerdoemsa',

        ]);

        $this->resetValidation([
            'file_name_alcaldia',
            'file_name_actalider',
            'file_name_acuerdoemsa',

        ]);
    }

    public function render()
    {
        $creacionsubnormal = $this->readyToLoad ? $this->chargingData() : [];
        return view('livewire.crear-subnormal.show', compact('creacionsubnormal'));
    }

    public $querySectorName = '';
    public $queryControlTerreno = '';
    public $queryControlcodefactura = '';

    public function chargingData()
    {
        return CrearSubnormal::where(function ($query) {
            if ($this->querySectorName) {
                $query->where('sector_name', 'like', '%' . $this->querySectorName . '%');
            }
            if ($this->queryControlTerreno) {
                // Utilizamos whereHas con una función de restricción personalizada
                $query->whereHas('controlterreno', function ($subQuery) {
                    // Filtramos por la columna code_macromedidor
                    $subQuery->where('code_macromedidor', 'like', '%' . $this->queryControlTerreno . '%');
                });
            }
            if ($this->queryControlcodefactura) {
                // Utilizamos whereHas con una función de restricción personalizada
                $query->whereHas('codefactura', function ($subQuery) {
                    // Filtramos por la columna code_macromedidor
                    $subQuery->where('invoice_code', 'like', '%' . $this->queryControlcodefactura . '%');
                });
            }

        })->paginate($this->cant);
    }

    public function resetFilter(){
        $this->reset(['querySectorName','queryControlTerreno','queryControlcodefactura']);
    }


    public function mount()
    {
        $this->User = User::all();
        $this->loggedUser = Auth::user();
        $this->loggedUserRole = $this->loggedUser->getRoleNames()->first();

        $this->listdocuments = Documentsalcaldias::all();

        $this->municipily=municipalities::all();



        // Inicializar $notificationSent usando los valores almacenados en la sesión
        foreach (CrearSubnormal::all() as $registro) {
            if (session()->has('notification_sent_' . $registro->id)) {
                $this->notificationSent[$registro->id] = session()->get('notification_sent_' . $registro->id);
            }
        }

    }


    public function showDocumentInfo()
    {
        $this->showDocumentInfo = true; // Establecer la propiedad a true para mostrar la información en el offcanvas
    }


    protected function rules()
    {
        return [
            'file_name_alcaldia' => ['required_if:creatingCertificate', 'file', 'mimes:pdf'],
            'file_name_actalider' => ['required_if:creatingActa', 'file', 'mimes:pdf'],
            'file_name_acuerdoemsa' => ['required_if:creatingAcuerdoEMSA', 'file', 'max:2048'],
        ];
    }

    protected $messages = [
        'file_name_alcaldia.required_if' => 'El certificado es obligatorio',
        'file_name_alcaldia.file' => 'El certificado debe ser un archivo',
        'file_name_actalider.required_if' => 'El acta es obligatoria',
        'file_name_actalider.file' => 'El acta debe ser un archivo',
        'file_name_acuerdoemsa.required_if' => 'El acuerdo EMSA es obligatorio',
        'file_name_acuerdoemsa.file' => 'El acuerdo EMSA debe ser un archivo',
    ];

    public function store()
    {
        $this->validate([
            'file_name_alcaldia' => ['required', 'file', 'mimes:pdf'],
        ]);

        // Buscar si ya existe un registro con el mismo nombre de archivo
        $existingRecord = CrearSubnormal::where('file_name_alcaldia', $this->file_name_alcaldia->getClientOriginalName())->first();

        if ($existingRecord) {
            // Si existe un registro con el mismo nombre de archivo, simplemente actualiza el nombre del archivo
            $originalFilename_alcaldia = $this->file_name_alcaldia->getClientOriginalName();
            $filenameWithoutExtension = pathinfo($originalFilename_alcaldia, PATHINFO_FILENAME);
            $filename_alcaldia = $filenameWithoutExtension;
            $slugifiedFilename_alcaldia = Str::slug($filename_alcaldia);
            $this->file_name_alcaldia->storeAs('uploads/leagues/files', $slugifiedFilename_alcaldia . '.' . $this->file_name_alcaldia->getClientOriginalExtension(),'league');

            $existingRecord->file_name_alcaldia = $slugifiedFilename_alcaldia . '.' . $this->file_name_alcaldia->getClientOriginalExtension();

            // Guardar el registro actualizado en la base de datos
            $existingRecord->save();
        } else {
            // Si no existe un registro con el mismo nombre de archivo, muestra un mensaje de error
            $this->addError('file_name_alcaldia', 'No se encontró un registro existente con el mismo nombre de archivo.');
        }

        // Emitir eventos y limpiar los campos del formulario
        $this->emitTo('CrearSubnormal.show', 'render');
        $this->emit('alert', __('File uploaded!'), '#create');
        $this->emit('crearsubnormalShowRender');
        $this->closeAndClean();
    }


    public function storeacta()
    {
        //$this->creatingActa = true;
        $this->validate();
        $originalFilename_acta = $this->file_name_actalider->getClientOriginalName();
        $filenameWithoutExtension = pathinfo($originalFilename_acta, PATHINFO_FILENAME);
        $filename_acta =$filenameWithoutExtension;
        $slugifiedFilename_acta = Str::slug($filename_acta);
        $this->file_name_actalider->storeAs('uploads/subnormal/', $slugifiedFilename_acta . '.' . $this->file_name_actalider->getClientOriginalExtension());


        $crear_acta = new CrearSubnormal();

        $crear_acta->file_name_actalider = $slugifiedFilename_acta . '.' . $this->file_name_actalider->getClientOriginalExtension();


       $crear_acta->save();

        $this->emitTo('CrearSubnormal.show','render');
        $this->emit('alert',__('File uploaded!'),'#cargarActa');
        $this->emit('crearsubnormalShowRender');
        $this->closeAndClean();
    }

    public function storeacuerdo()
    {
        //$this->creatingAcuerdoEMSA = true;
        $this->validate();
        $originalFilename_acuerdo = $this->file_name_acuerdoemsa->getClientOriginalName();
        $filenameWithoutExtension_acuerdo = pathinfo($originalFilename_acuerdo, PATHINFO_FILENAME);
        $filename_acuerdo =$filenameWithoutExtension_acuerdo;
        $slugifiedFilename_acuardo = Str::slug($filename_acuerdo);
        $this->file_name_acuerdoemsa->storeAs('uploads/subnormal/', $slugifiedFilename_acuardo . '.' . $this->file_name_acuerdoemsa->getClientOriginalExtension());


        $crear_acuerdo = new CrearSubnormal();

        $crear_acuerdo->file_name_acuerdoemsa = $slugifiedFilename_acuardo . '.' . $this->file_name_acuerdoemsa->getClientOriginalExtension();


       $crear_acuerdo->save();

        $this->emitTo('CrearSubnormal.show','render');
        $this->emit('alert',__('File uploaded!'),'#cargarActa');
        $this->emit('crearsubnormalShowRender');
        $this->closeAndClean();
    }

        //Función para editar un registro
        public function edit($editar_subnormal)
        {
            $this->editar_subnormal = CrearSubnormal::find($editar_subnormal);

            $this->sector_name= $this->editar_subnormal->sector_name;
            $this->phone= $this->editar_subnormal->phone;
            $this->address= $this->editar_subnormal->address;
            $this->municipios_zone_id= $this->editar_subnormal->municipios_zone_id;

        }

        //Función para listar documentos

        public function listadoDocumento($listadoDocumento)
        {
            $this->listadoDocumento = CrearSubnormal::find($listadoDocumento);

            $this->sector_name= $this->listadoDocumento->sector_name;
            $this->phone= $this->listadoDocumento->phone;
            $this->address= $this->listadoDocumento->address;

        }

        public $control_terrenos_id;


        //Función para cargar el certificado
        public function cargarCertificado($crear_certificado_id)
        {

            // Obtener el modelo correspondiente al ID
            $crear_certificado = CrearSubnormal::find($crear_certificado_id);

            // Verificar si se encontró el certificado
            if ($crear_certificado) {
                // Guardar el ID en alguna propiedad o variable
                $this->zona_subnormal_id = $crear_certificado_id;

                // Asignar otras propiedades según las necesidades
                $this->control_terrenos_id = $crear_certificado->control_terrenos_id;
                $this->sector_name = $crear_certificado->sector_name;
                $this->invoice_code = $crear_certificado->invoice_code;
                $this->phone = $crear_certificado->phone;
                $this->file_name_alcaldia = $crear_certificado->file_name_alcaldia;

                // Actualizar el estado de $certificadoCargado después de cargar el certificado
                $crear_certificado->certificadoCargado = true;
                $this->certificadoCargado = true;
            } else {
                // Manejar el caso en el que el certificado no se encuentre
                // Puedes mostrar un mensaje de error o realizar alguna otra acción
                // Por ejemplo, establecer $this->zona_subnormal_id en null o algún otro valor predeterminado
                $this->zona_subnormal_id = null;
                // También puedes establecer $this->certificadoCargado en false si el certificado no se encontró
                $this->certificadoCargado = false;
            }
            $this->certificadoCargado = true;
        }


        //Función para cargar el acta
        public function cargarActa($crear_acta)
        {


            // Obtener el modelo correspondiente al ID
            $crear_certificado_lider = CrearSubnormal::find($crear_acta);

            // Verificar si se encontró el certificado
            if ($crear_certificado_lider) {
                // Guardar el ID en alguna propiedad o variable
                $this->zona_subnormal_id = $crear_acta;

                // Asignar otras propiedades según las necesidades
                $this->control_terrenos_id = $crear_certificado_lider->control_terrenos_id;
                $this->sector_name = $crear_certificado_lider->sector_name;
                $this->invoice_code = $crear_certificado_lider->invoice_code;
                $this->phone = $crear_certificado_lider->phone;
                $this->file_name_actalider = $crear_certificado_lider->file_name_actalider;

                // Actualizar el estado de $certificadoCargado después de cargar el certificado
                $crear_certificado_lider->actaCargada = true;
                $this->actaCargada = true;
            } else {
                // Manejar el caso en el que el certificado no se encuentre
                // Puedes mostrar un mensaje de error o realizar alguna otra acción
                // Por ejemplo, establecer $this->zona_subnormal_id en null o algún otro valor predeterminado
                $this->zona_subnormal_id = null;
                // También puedes establecer $this->certificadoCargado en false si el certificado no se encontró
                $this->actaCargada = false;
            }
            $this->actaCargada = false;


        }

        //Función para cargar el acuerdo
        public function cargarAcuerdo($crear_acuerdo)
        {


            // Obtener el modelo correspondiente al ID
            $crear_certificado_lider = CrearSubnormal::find($crear_acuerdo);

            // Verificar si se encontró el certificado
            if ($crear_certificado_lider) {
                // Guardar el ID en alguna propiedad o variable
                $this->zona_subnormal_id = $crear_acuerdo;

                // Asignar otras propiedades según las necesidades
                $this->control_terrenos_id = $crear_certificado_lider->control_terrenos_id;
                $this->sector_name = $crear_certificado_lider->sector_name;
                $this->invoice_code = $crear_certificado_lider->invoice_code;
                $this->phone = $crear_certificado_lider->phone;
                $this->file_name_acuerdoemsa = $crear_certificado_lider->file_name_acuerdoemsa;

                // Actualizar el estado de $certificadoCargado después de cargar el certificado
                $crear_certificado_lider->acuerdoCargado = true;
                $this->acuerdoCargado = true;
            } else {
                // Manejar el caso en el que el certificado no se encuentre
                // Puedes mostrar un mensaje de error o realizar alguna otra acción
                // Por ejemplo, establecer $this->zona_subnormal_id en null o algún otro valor predeterminado
                $this->zona_subnormal_id = null;
                // También puedes establecer $this->certificadoCargado en false si el certificado no se encontró
                $this->acuerdoCargado = false;
            }



            $this->acuerdoCargado = false;


        }

        //funcion codigo factura tesoreria
        public function invoicecode($crear_invoicecode)
        {


            // Obtener el modelo correspondiente al ID
            $crear_certificado_lider = CrearSubnormal::find($crear_invoicecode);

            // Verificar si se encontró el certificado
            if ($crear_certificado_lider) {
                // Guardar el ID en alguna propiedad o variable
                $this->zona_subnormal_id = $crear_invoicecode;

                // Asignar otras propiedades según las necesidades
                $this->control_terrenos_id = $crear_certificado_lider->control_terrenos_id;
                $this->sector_name = $crear_certificado_lider->sector_name;
                $this->invoice_code = $crear_certificado_lider->invoice_code;
                $this->phone = $crear_certificado_lider->phone;
                $this->file_name_acuerdoemsa = $crear_certificado_lider->file_name_acuerdoemsa;

                // Actualizar el estado de $certificadoCargado después de cargar el certificado
                $crear_certificado_lider->acuerdoCargado = true;
                $this->acuerdoCargado = true;
            } else {
                // Manejar el caso en el que el certificado no se encuentre
                // Puedes mostrar un mensaje de error o realizar alguna otra acción
                // Por ejemplo, establecer $this->zona_subnormal_id en null o algún otro valor predeterminado
                $this->zona_subnormal_id = null;
                // También puedes establecer $this->certificadoCargado en false si el certificado no se encontró
                $this->acuerdoCargado = false;
            }



            $this->acuerdoCargado = false;


        }

        public $notificationSent = [];



        public function handleClickButton($registroId)
        {

            // Obtener el registro específico utilizando el ID proporcionado
            $registro = CrearSubnormal::find($registroId);

            // Verificar si el registro existe
            if ($registro) {
                // Obtener la lista de usuarios con el rol 'Grupo Social'
                $usuariosAdmin = User::whereHas('roles', function ($query) {
                    $query->where('name', 'Centro de Inteligencia')
                        ->orWhere('name', 'Control de Energía');
                })->get();

                // Para cada usuario, enviar el correo electrónico con los datos del registro
                foreach ($usuariosAdmin as $usuario) {
                    Mail::to($usuario->email)->send(new NotificacioncodeTesoreria($registro));
                }

                // Mostrar una alerta o mensaje de éxito si lo deseas
                session()->flash('message', 'Correo electrónico enviado a los usuarios de Centro de inteligencia.');

                // Establecer notificationSent en true para este registro
                $this->notificationSent[$registroId] = true;

                // Almacenar el estado de la notificación en la sesión
                session()->put('notification_sent_' . $registroId, true);
            } else {
                // Si el registro no existe, mostrar un mensaje de error
                session()->flash('error', 'El registro no fue encontrado.');
            }

            // Emitir un evento para renderizar la vista nuevamente y mostrar el mensaje de alerta
            $this->emit('alert', __('Email sent to billing'), '#edit');
            $this->closeAndClean();
            return redirect()->route('CrearSubNormal.index');
        }










        //Función para actualizar un registro
        public function update()
        {


            $this->editar_subnormal->sector_name=$this->sector_name;
            $this->editar_subnormal->phone = $this->phone;
            $this->editar_subnormal->address = $this->address;
            $this->editar_subnormal->municipios_zone_id = $this->municipios_zone_id;


            $this->editar_subnormal->save();

            $this->emitTo('crear-subnormal.show','render');
            $this->emit('alert',__('Updated court!'),'#edit');
            $this->emit('crearsubnormalShowRender');
        }

        //Función para actualizar el certificado
        public function updatecertificado()
        {
            //$this->creatingCertificate = true;
            $this->validate([
                'file_name_alcaldia' => ['required', 'file', 'mimes:pdf'],
            ]);

            $originalFilename_alcaldia = $this->file_name_alcaldia->getClientOriginalName();
            $filenameWithoutExtension = pathinfo($originalFilename_alcaldia, PATHINFO_FILENAME);
            $slugifiedFilename_alcaldia = Str::slug($filenameWithoutExtension);
            $this->file_name_alcaldia->storeAs('uploads/subnormal/', $slugifiedFilename_alcaldia . '.' . $this->file_name_alcaldia->getClientOriginalExtension());


            $this->crear_certificado->file_name_alcaldia = $slugifiedFilename_alcaldia . '.' . $this->file_name_alcaldia->getClientOriginalExtension();


            $this->crear_certificado->save();
            $this->emitTo('crear-subnormal.show','render');
            $this->emit('alert',__('Updated court!'),'#cargarCertificado');
            $this->emit('crearsubnormalShowRender');

        }

        //Función para actualizar el acta
        public function updateacta()
        {

            //$this->creatingActa = true;
            $this->validate([
                'file_name_actalider' => ['required', 'file', 'mimes:pdf'],
            ]);

            $originalFilename_acta= $this->file_name_actalider->getClientOriginalName();
            $filenameWithoutExtension_acta = pathinfo($originalFilename_acta, PATHINFO_FILENAME);
            $slugifiedFilename_acta = Str::slug($filenameWithoutExtension_acta);
            $this->file_name_actalider->storeAs('uploads/subnormal/', $slugifiedFilename_acta . '.' . $this->file_name_actalider->getClientOriginalExtension());


            $this->crear_acta->file_name_actalider = $slugifiedFilename_acta . '.' . $this->file_name_actalider->getClientOriginalExtension();


            $this->crear_acta->save();
            $this->emitTo('crear-subnormal.show','render');
            $this->emit('alert',__('Updated acta lider!'),'#cargarActa');
            $this->emit('crearsubnormalShowRender');

        }

        //Función para actualizar el acuerdo
        public function updateacuerdo()
        {

            //$this->creatingAcuerdoEMSA = true;
            $this->validate([
                'file_name_acuerdoemsa' => ['required', 'file', 'max:2048'],
            ]);

            $originalFilename_acta= $this->file_name_acuerdoemsa->getClientOriginalName();
            $filenameWithoutExtension_acta = pathinfo($originalFilename_acta, PATHINFO_FILENAME);
            $slugifiedFilename_acta = Str::slug($filenameWithoutExtension_acta);
            $this->file_name_acuerdoemsa->storeAs('uploads/subnormal/', $slugifiedFilename_acta . '.' . $this->file_name_acuerdoemsa->getClientOriginalExtension());


            $this->crear_acuerdo->file_name_acuerdoemsa = $slugifiedFilename_acta . '.' . $this->file_name_acuerdoemsa->getClientOriginalExtension();


            $this->crear_acuerdo->save();
            $this->emitTo('crear-subnormal.show','render');
            $this->emit('alert',__('Updated acta lider!'),'#cargarAcuerdo');
            $this->emit('crearsubnormalShowRender');

        }



        public $created_at_actaRepresentante;
        public $created_at_certificadoAlcaldia;
        public $created_at_actaEmsa;
        public $Id_certificadoAlcaldia;
        public $created_at_certificadoAlcaldia_anual;
        public $created_at_actalider_anual;
        public $created_at_actaemsa_anual;

        // Método para recuperar los documentos de las tres tablas
    public function retrieveDocuments($zonaSubnormalId)
    {
        $actaRepresentante = DocumentsLider::where('zona_subnormal_id', $zonaSubnormalId)->first();
        $certificadoAlcaldia = Documentsalcaldias::where('zona_subnormal_id', $zonaSubnormalId)->first();
        $actaEmsa = DocumentsAcuerdoemsa::where('zona_subnormal_id', $zonaSubnormalId)->first();

        $this->docAlcaldiaa = $certificadoAlcaldia ? $certificadoAlcaldia->file_name_alcaldia : null;
        $this->doclideer = $actaRepresentante ? $actaRepresentante->file_name_actalider : null;
        $this->docacuerdoemsaa = $actaEmsa ? $actaEmsa->file_name_acuerdoemsa : null;


        // Obtener la fecha de creación de los documentos
        $this->created_at_actaRepresentante = $actaRepresentante ? $actaRepresentante->start_date : null;
        $this->created_at_certificadoAlcaldia = $certificadoAlcaldia ? $certificadoAlcaldia->start_date : null;
        $this->created_at_actaEmsa = $actaEmsa ? $actaEmsa->start_date : null;


        // Calcular la fecha de vencimiento del certificado de alcaldía (1 año después de la fecha de inicio)
        $this->created_at_certificadoAlcaldia_anual = $certificadoAlcaldia ? Carbon::parse($certificadoAlcaldia->start_date)->addYear() : null;

         // Calcular la fecha de vencimiento del acta del lider (1 año después de la fecha de inicio)
         $this->created_at_actalider_anual = $actaRepresentante ? Carbon::parse($actaRepresentante->start_date)->addYear() : null;

          // Calcular la fecha de vencimiento del acta emsa (1 año después de la fecha de inicio)
          $this->created_at_actaemsa_anual = $actaEmsa ? Carbon::parse($actaEmsa->start_date)->addYear() : null;






        $this->emit('showDocumentModal');
    }


}

