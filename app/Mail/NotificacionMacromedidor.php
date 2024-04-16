<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Controlterreno;

class NotificacionMacromedidor extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = 'Notificación de Generación de Macromedidor';
    public $data;
    public $terreno;
    public $dataCaminante;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //

        $this->data = $data;
        //$this->terreno = Controlterreno::findOrFail($data['data_caminante_id']);
        $this->terreno = Controlterreno::with('Datoscaminante')->findOrFail($data['data_caminante_id']);

         // Cargar los datos relacionados de la tabla data_caminante
         $this->dataCaminante = $this->terreno->Datoscaminante;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $data = [
            'data' => $this->data,
           
        ];

        return $this->view('emails.NotificaciondeGeneracionmacromedidor', $data);
    }
}
