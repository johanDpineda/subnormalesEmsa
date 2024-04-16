<?php

namespace App\Http\Livewire\Censo;

use App\Models\Codesiec as ModelsCodesiec;
use App\Models\Codesiecsubnormales;
use App\Models\Invoicecode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Codesiec extends Component
{
    use WithFileUploads;

    public $invoice_code;
    public $zona_subnormal_id;
    public $creacionsubnormals;

    public $codigosiecsub;
    public $codigo_siec;

    public $start_date;


    protected function rules()
    {
        return [
            'codigo_siec' => ['required'],

        ];
    }

    protected $messages = [
        'codigo_siec.required' => 'El Codigo Siec es obligatorio.'

    ];

    public function closeAndClean()
    {
        $this->reset(['codigo_siec']);
        $this->resetValidation();
    }

    public function save()
    {
        $this->validate();


        // Crear o actualizar el registro en la base de datos
        $existingRecord = Codesiecsubnormales::where('censo_id', $this->codigosiecsub)->first();
        if ($existingRecord) {
            // Si ya existe un registro, simplemente actualizar el nombre del archivo y la fecha de inicio

            $existingRecord->codigo_siec = $this->codigo_siec; // Añadir la fecha de inicio
            $existingRecord->save();
        } else {
            // Si no existe un registro, crear uno nuevo
            Codesiecsubnormales::create([
                'codigo_siec' => $this->codigo_siec, // Añadir la fecha de inicio
                'censo_id' => $this->codigosiecsub,

            ]);
        }

        // Emitir eventos y limpiar los campos del formulario
        $this->emitTo('CrearSubnormal.show', 'render');
        $this->emit('alert', __('Updated Siec Code'), '#cargarCertificado');
        $this->emit('crearsubnormalShowRender');
        $this->closeAndClean();



        return redirect()->route('censofamilia.index');
    }



    public function render()
    {
        return view('livewire.censo.codesiec');
    }
}


