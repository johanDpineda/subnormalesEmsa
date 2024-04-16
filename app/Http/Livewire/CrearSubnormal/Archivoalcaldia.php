<?php

namespace App\Http\Livewire\CrearSubnormal;

use App\Models\Documentsalcaldias;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Archivoalcaldia extends Component
{
    use WithFileUploads;

    public $file_name_alcaldia;
    public $zona_subnormal_id;
    public $creacionsubnormals;
    public $cargarCertificado;
    public $docAlcaldiaa;

    public $start_date;


    protected function rules()
    {
        return [
            'file_name_alcaldia' => ['required', 'file', 'mimes:pdf'],
            'start_date' => ['required', 'date'],
        ];
    }

    protected $messages = [
        'file_name_alcaldia.required' => 'El acta es obligatoria.',
        'file_name_alcaldia.file' => 'El acta debe ser un archivo.',
        'file_name_alcaldia.mimes' => 'El acta debe ser un archivo PDF.',
        'start_date.required'=>'El campo fecha es obligatorio'
    ];

    public function closeAndClean()
    {
        $this->reset(['file_name_alcaldia']);
        $this->resetValidation();
    }

    public function save()
    {
        $this->validate();

        // Obtener el nombre de archivo y guardarlo
        $originalFilename_alcaldia = $this->file_name_alcaldia->getClientOriginalName();
        $filenameWithoutExtension = pathinfo($originalFilename_alcaldia, PATHINFO_FILENAME);
        $filename_alcaldia = $filenameWithoutExtension;
        $slugifiedFilename_alcaldia = Str::slug($filename_alcaldia);
        $this->file_name_alcaldia->storeAs('uploads/acuerdoAlcaldia', $slugifiedFilename_alcaldia . '.' . $this->file_name_alcaldia->getClientOriginalExtension(), 'league');

        // Crear o actualizar el registro en la base de datos
        $existingRecord = Documentsalcaldias::where('zona_subnormal_id', $this->docAlcaldiaa)->first();
        if ($existingRecord) {
            // Si ya existe un registro, simplemente actualizar el nombre del archivo y la fecha de inicio
            $existingRecord->file_name_alcaldia = $slugifiedFilename_alcaldia . '.' . $this->file_name_alcaldia->getClientOriginalExtension();
            $existingRecord->start_date = $this->start_date; // Añadir la fecha de inicio
            $existingRecord->save();
        } else {
            // Si no existe un registro, crear uno nuevo
            Documentsalcaldias::create([
                'file_name_alcaldia' => $slugifiedFilename_alcaldia . '.' . $this->file_name_alcaldia->getClientOriginalExtension(),
                'zona_subnormal_id' => $this->docAlcaldiaa,
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
        return view('livewire.crear-subnormal.archivoalcaldia');
    }
}
