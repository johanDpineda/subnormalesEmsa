<?php

namespace App\Http\Livewire\CrearSubnormal;

use App\Models\Invoicecode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class CodeTesoreria extends Component
{
    use WithFileUploads;

    public $invoice_code;
    public $zona_subnormal_id;
    public $creacionsubnormals;
    public $invoicecode;
    public $codefactura;

    public $start_date;


    protected function rules()
    {
        return [
            'invoice_code' => ['required'],

        ];
    }

    protected $messages = [
        'invoice_code.required' => 'El Codigo de factura es obligatorio.'

    ];

    public function closeAndClean()
    {
        $this->reset(['invoice_code']);
        $this->resetValidation();
    }

    public function save()
    {
        $this->validate();


        // Crear o actualizar el registro en la base de datos
        $existingRecord = Invoicecode::where('zona_subnormal_id', $this->codefactura)->first();
        if ($existingRecord) {
            // Si ya existe un registro, simplemente actualizar el nombre del archivo y la fecha de inicio

            $existingRecord->invoice_code = $this->invoice_code; // Añadir la fecha de inicio
            $existingRecord->save();
        } else {
            // Si no existe un registro, crear uno nuevo
            Invoicecode::create([
                'invoice_code' => $this->invoice_code, // Añadir la fecha de inicio
                'zona_subnormal_id' => $this->codefactura,

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
        return view('livewire.crear-subnormal.code-tesoreria');
    }
}

