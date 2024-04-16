<?php

namespace App\Http\Livewire\CrearSubnormal;


use App\Models\DocumentsAcuerdoemsa;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Archivoacuerdoemsa extends Component
{
    use WithFileUploads;

    public $file_name_acuerdoemsa;
    public $zona_subnormal_id;
    public $creacionsubnormals;
    public $cargarCertificado;
    public $docacuerdoemsaa;

    public $start_date;

    protected function rules()
    {
        return [
            'file_name_acuerdoemsa' => ['required', 'file', 'mimes:pdf'],
            'start_date' => ['required', 'date'],
        ];
    }

    protected $messages = [
        'file_name_acuerdoemsa.required' => 'El acta emsa es obligatoria.',
        'file_name_acuerdoemsa.file' => 'El acta debe ser un archivo.',
        'file_name_acuerdoemsa.mimes' => 'El acta debe ser un archivo PDF.',
        'start_date.required'=>'El campo fecha es obligatorio'
    ];

    public function closeAndClean()
    {
        $this->reset(['file_name_acuerdoemsa']);
        $this->resetValidation();
    }

    public function save()
    {
        $this->validate();



        // Obtener el nombre de archivo y guardarlo
        $originalFilename_actaemsa = $this->file_name_acuerdoemsa->getClientOriginalName();
        $filenameWithoutExtension = pathinfo($originalFilename_actaemsa, PATHINFO_FILENAME);
        $filename_actaemsa = $filenameWithoutExtension;
        $slugifiedFilename_actaemsa = Str::slug($filename_actaemsa);
        $this->file_name_acuerdoemsa->storeAs('uploads/acuerdoemsa', $slugifiedFilename_actaemsa . '.' . $this->file_name_acuerdoemsa->getClientOriginalExtension(), 'league');

        // Crear o actualizar el registro en la base de datos
        $existingRecord = DocumentsAcuerdoemsa::where('zona_subnormal_id', $this->docacuerdoemsaa)->first();
        if ($existingRecord) {
            // Si ya existe un registro, simplemente actualizar el nombre del archivo
            $existingRecord->file_name_acuerdoemsa = $slugifiedFilename_actaemsa . '.' . $this->file_name_acuerdoemsa->getClientOriginalExtension();
            $existingRecord->start_date = $this->start_date; // Añadir la fecha de inicio
            $existingRecord->save();
        } else {
            // Si no existe un registro, crear uno nuevo
            DocumentsAcuerdoemsa::create([
                'file_name_acuerdoemsa' => $slugifiedFilename_actaemsa . '.' . $this->file_name_acuerdoemsa->getClientOriginalExtension(),
                'zona_subnormal_id' => $this->docacuerdoemsaa,
                'start_date' => $this->start_date
            ]);
        }


        // Emitir eventos y limpiar los campos del formulario
        $this->emitTo('CrearSubnormal.show', 'render');
        $this->emit('alert', __('File uploaded!'), '#cargarCertificado');
        $this->emit('crearsubnormalShowRender');
        $this->closeAndClean();

        return redirect()->route('CrearSubNormal.index');
    }


    public function render()
    {
        return view('livewire.crear-subnormal.archivoacuerdoemsa');
    }
}
