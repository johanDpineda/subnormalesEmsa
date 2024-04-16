<?php

namespace App\Http\Livewire\Censo;

use App\Exports\Censozonesubnormal;
use App\Models\Censo;
use App\Models\CrearSubnormal;
use App\Models\Documentocenso;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
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
    public $cargarcenso;


    public $crear_certificado_id;

    //llamados las variables el cual abre el modal para la subida de los documentos
    public $docAlcaldiaa;
    public $doclideer;
    public $docacuerdoemsaa;

    public $codigosiecsub;




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



    public $User;


    public $sector_name;
    public $phone;
    public $address;
    public $invoice_code='';
    public $listadoDocumento;
    public $start_date;
    public $documentsToExpire;

    public $alerts;


    public $doccenso;








    protected $listeners = [
        'CourtsShowChange',
        'crearsubnormalShowRender' => 'render'
    ];

    public $readyToLoad = false;
    public $maintenance = false;
    public $query = '';
    public $cant = '10';
    protected $queryString = [
        'cant' => ['except' => '10'],
        'query' => ['except' => '']
    ];

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
        $censofamiliasubnormals = $this->readyToLoad ? $this->chargingData() : [];
        return view('livewire.censo.show', compact('censofamiliasubnormals'));
    }

    public function exportarExcel()
    {

        // Exportar los datos a un archivo Excel
        return Excel::download(new Censozonesubnormal, 'Censo_Subnormales.xlsx');
    }

    public $querycodemacro = '';
    public $querycc = '';
    public $querynamerepresentante = '';
    public $queryfechacenso = '';

    public function chargingData()
    {
        return Censo::where(function ($query) {
            if ($this->query) {
                $query->whereHas('Datoszonas', function ($subQuery) {
                    $subQuery->where('sector_name', 'like', '%' . $this->query . '%');
                });
            }

            if ($this->querycodemacro) {
                // Utilizamos whereHas con una función de restricción personalizada
                $query->whereHas('Datoszonas', function ($subqquery) {
                    $subqquery->whereHas('controlterreno', function ($subQuery) {
                          // Filtramos por la columna code_macromedidor
                        $subQuery->where('code_macromedidor', 'like', '%' . $this->querycodemacro . '%');
                    });

                });
            }

            if ($this->querynamerepresentante) {
                // Utilizamos whereHas con una función de restricción personalizada
                $query->whereHas('Datoszonas', function ($subqquery) {
                    $subqquery->whereHas('controlterreno', function ($subqqueryname) {
                        $subqqueryname->whereHas('Datoscaminante', function ($subQuerynamerepresentante) {
                             // Filtramos por la columna code_macromedidor
                            $subQuerynamerepresentante->where('name', 'like', '%' . $this->querynamerepresentante . '%');

                        });

                    });

                });
            }


            if ($this->querycc) {
                $query->orWhere('cedula_lider', 'like', '%' . $this->querycc . '%');
            }

            if ($this->queryfechacenso) {
                $query->orWhere('fecha_censo', 'like', '%' . $this->queryfechacenso . '%');
            }

        })->paginate($this->cant);
    }

    public function resetFilter(){
        $this->reset(['queryfechacenso','querycc','querynamerepresentante','querycodemacro','query']);
    }


    public function mount()
    {
        $this->User = User::all();
        $this->loggedUser = Auth::user();
        $this->loggedUserRole = $this->loggedUser->getRoleNames()->first();




    }

      //Función para cargar el certificado
      public function cargarcenso($crear_certificado_id)
      {

          // Obtener el modelo correspondiente al ID
          $crear_certificado = Censo::find($crear_certificado_id);

          // Verificar si se encontró el certificado
          if ($crear_certificado) {
              // Guardar el ID en alguna propiedad o variable
              $this->zona_subnormal_id = $crear_certificado_id;

              // Asignar otras propiedades según las necesidades

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


      //funcion codigo factura tesoreria
      public function invoicecode($crear_invoicecode)
      {


          // Obtener el modelo correspondiente al ID
          $crear_certificado_lider = Censo::find($crear_invoicecode);

          // Verificar si se encontró el certificado
          if ($crear_certificado_lider) {
              // Guardar el ID en alguna propiedad o variable
              $this->zona_subnormal_id = $crear_invoicecode;

              // Asignar otras propiedades según las necesidades

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






        //Función para editar un registro
        public function edit($editar_subnormal)
        {
            $this->editar_subnormal = CrearSubnormal::find($editar_subnormal);

            $this->sector_name= $this->editar_subnormal->sector_name;
            $this->phone= $this->editar_subnormal->phone;
            $this->address= $this->editar_subnormal->address;

        }


        //Función para actualizar un registro
        public function update()
        {


            $this->editar_subnormal->sector_name=$this->sector_name;
            $this->editar_subnormal->phone = $this->phone;
            $this->editar_subnormal->address = $this->address;

            $this->editar_subnormal->save();

            $this->emitTo('crear-subnormal.show','render');
            $this->emit('alert',__('Updated court!'),'#edit');
            $this->emit('crearsubnormalShowRender');
        }

           // Método para recuperar los documentos de las tres tablas
           public $created_at_censo;
           public $created_at_censo_anual;



        public function viewcenso($zonaSubnormalId)
        {
             // Agregar una declaración para verificar si el flujo llega a este método

            $actaRepresentante = Documentocenso::where('censo_id', $zonaSubnormalId)->first();

            $actacensod = Censo::where('zona_subnormal_id', $zonaSubnormalId)->first();


            $this->doccenso = $actaRepresentante ? $actaRepresentante->file_name_censo : null;

            $this->created_at_censo = $actacensod ? $actacensod->fecha_censo : null;




            $this->emit('showDocumentModal');
        }












}

