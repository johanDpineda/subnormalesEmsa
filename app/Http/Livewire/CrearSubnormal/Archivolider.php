<?php

namespace App\Http\Livewire\CrearSubnormal;

use App\Models\DocumentsLider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Archivolider extends Component
{
    use WithFileUploads;

    public $file_name_actalider;
    public $zona_subnormal_id;
    public $creacionsubnormals;
    public $cargarCertificado;
    public $doclideer;

    public $start_date;


    protected function rules()
    {
        return [
            'file_name_actalider' => ['required', 'file', 'mimes:pdf'],
            'start_date' => ['required', 'date'],
        ];
    }

    protected $messages = [
        'file_name_actalider.required' => 'El acta es obligatoria.',
        'file_name_actalider.file' => 'El acta debe ser un archivo.',
        'file_name_actalider.mimes' => 'El acta debe ser un archivo PDF.',
        'start_date.required'=>'El campo fecha es obligatorio'
    ];

    public function closeAndClean()
    {
        $this->reset(['file_name_actalider']);
        $this->resetValidation();
    }

    public function save()
    {
        $this->validate();



        // Obtener el nombre de archivo y guardarlo
        $originalFilename_lider = $this->file_name_actalider->getClientOriginalName();
        $filenameWithoutExtension = pathinfo($originalFilename_lider, PATHINFO_FILENAME);
        $filename_lider = $filenameWithoutExtension;
        $slugifiedFilename_lider = Str::slug($filename_lider);
        $this->file_name_actalider->storeAs('uploads/actalider', $slugifiedFilename_lider . '.' . $this->file_name_actalider->getClientOriginalExtension(), 'league');

        // Crear o actualizar el registro en la base de datos
        $existingRecord = DocumentsLider::where('zona_subnormal_id', $this->doclideer)->first();
        if ($existingRecord) {
            // Si ya existe un registro, simplemente actualizar el nombre del archivo
            $existingRecord->file_name_actalider = $slugifiedFilename_lider . '.' . $this->file_name_actalider->getClientOriginalExtension();
            $existingRecord->start_date = $this->start_date; // Añadir la fecha de inicio
            $existingRecord->save();
        } else {
            // Si no existe un registro, crear uno nuevo
            DocumentsLider::create([
                'file_name_actalider' => $slugifiedFilename_lider . '.' . $this->file_name_actalider->getClientOriginalExtension(),
                'zona_subnormal_id' => $this->doclideer,
                'start_date' => $this->start_date, // Añadir la fecha de inicio
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
        return view('livewire.crear-subnormal.archivolider');
    }
}
