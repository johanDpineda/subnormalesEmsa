<?php

namespace App\Mail;

use App\Models\Datoscaminante;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionTerrenoSubNormal extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = 'Notificación de nuevo Registro de zona subnormal';
    public $data;
    public $terreno;
    public $dataCaminante;
    public $dataredesstatus;
    public $statusnetworks;

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
        $this->terreno = Datoscaminante::with('user')->findOrFail($data['role_id']);
        $this->statusnetworks = Datoscaminante::with('networkstatus')->findOrFail($data['network_status_id']);

         // Cargar los datos relacionados de la tabla data_caminante
         $this->dataCaminante = $this->terreno->user;

         // Cargar los datos relacionados de la tabla data_caminante
         $this->dataredesstatus = $this->statusnetworks->networkstatus;

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

        return $this->view('emails.NotificaciondeTerrenoSubnormal', $data);
    }
}


