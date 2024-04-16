<?php

namespace App\Http\Livewire\Censo;

use App\Models\Documentocenso;
use App\Models\DocumentsAcuerdoemsa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Documentcenso extends Component
{
    use WithFileUploads;

    public $file_name_censo	;
    public $zona_subnormal_id;
    public $creacionsubnormals;
    public $cargarCertificado;
    public $doccenso;


      // Agregar la marca de tiempo updated_at
      public $timestamps = true;



    protected function rules()
    {
        return [
            'file_name_censo' => ['required', 'file', 'mimes:pdf,xls,xlsx'],

        ];
    }

    protected $messages = [
        'file_name_censo.required' => 'El acta emsa es obligatoria.',
        'file_name_censo.file' => 'El acta debe ser un archivo.',
        'file_name_censo.mimes' => 'El acta debe ser un archivo PDF o Excel.',

    ];

    public function closeAndClean()
    {
        $this->reset(['file_name_censo']);
        $this->resetValidation();
    }

    public function save()
    {
        $this->validate();

        // Obtener la fecha y hora actual
        $now = Carbon::now();




        // Obtener el nombre de archivo y guardarlo
        $originalFilename_censo = $this->file_name_censo->getClientOriginalName();
        $filenameWithoutExtension = pathinfo($originalFilename_censo, PATHINFO_FILENAME);
        $filename_censo = $filenameWithoutExtension;
        $slugifiedFilename_censo = Str::slug($filename_censo);
        $this->file_name_censo->storeAs('uploads/documentcenso', $slugifiedFilename_censo . '.' . $this->file_name_censo->getClientOriginalExtension(), 'league');

        // Crear o actualizar el registro en la base de datos
        $existingRecord = Documentocenso::where('censo_id', $this->doccenso)->first();
        if ($existingRecord) {
            // Si ya existe un registro, simplemente actualizar el nombre del archivo
            $existingRecord->file_name_censo = $slugifiedFilename_censo . '.' . $this->file_name_censo->getClientOriginalExtension();
            $existingRecord->updated_at = $now; // Asignar la fecha y hora actual
            $existingRecord->save();
        } else {
            // Si no existe un registro, crear uno nuevo
            Documentocenso::create([
                'file_name_censo' => $slugifiedFilename_censo . '.' . $this->file_name_censo->getClientOriginalExtension(),
                'censo_id' => $this->doccenso,
                'updated_at' => $now, // Asignar la fecha y hora actual

            ]);
        }


        // Emitir eventos y limpiar los campos del formulario
        $this->emitTo('CrearSubnormal.show', 'render');
        $this->emit('alert', __('Census document uploaded'), '#cargarCertificado');
        $this->emit('crearsubnormalShowRender');
        $this->closeAndClean();

        return redirect()->route('censofamilia.index');
    }


    public function render()
    {
        return view('livewire.censo.documentcenso');
    }
}

