<?php

namespace App\Http\Livewire\Wordkin;

use App\Models\Controlterreno;
use App\Models\CrearSubnormal;
use App\Models\Datoscaminante;
use App\Models\DocumentsAcuerdoemsa;
use App\Models\Invoicecode;
use App\Models\User;
use App\Models\UserNotification;
use App\Models\UserNotificationcodefactura;
use App\Models\UserNotificationcodemacro;
use App\Models\UserNotificationdocuments;
use App\Models\UserNotificationnewsubnormal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Notifications extends Component
{

    public $loggedUser;
    public $loggedUserRole;
    public $User;

    public $notificationdatacaminante;
    public $notificationcontrolterreno;
    public $notificationcrearsubnormal;
    public $notificationdocumentsexits;
    public $notificationcrearcodefactura;



    public $readyToLoad = false;

    public $notificacionesLeidas = [];
    public $notificacionesLeidascontrolterreno = [];
    public $notificacionesLeidascrearsubnormal = [];
    public $notificacionesLeidasdocumentsexits = [];
    public $notificacionesLeidascodefactura = [];


    public function mount()
    {
        $this->User = User::all();

        $this->loggedUser = Auth::user();
        $this->loggedUserRole = $this->loggedUser->getRoleNames()->first();

         // Obtener las notificaciones de Datoscaminante solo si el usuario no es 'Caminante', 'Grupo Social' o 'Control de energia'
        if (!$this->loggedUser->hasRole('Caminante') && !$this->loggedUser->hasRole('Grupo Social') && !$this->loggedUser->hasRole('Control de energia')) {
            $this->notificationdatacaminante = Datoscaminante::all();
        } else {
            $this->notificationdatacaminante = collect(); // Colección vacía si el usuario tiene uno de los roles especificados
        }



          // Obtener las notificaciones de Datoscaminante solo si el usuario no es 'Caminante', 'Grupo Social' o 'Control de energia'
          if (!$this->loggedUser->hasRole('Caminante') && !$this->loggedUser->hasRole('Centro de Inteligencia') && !$this->loggedUser->hasRole('Control de energia')) {
            $this->notificationcontrolterreno = Controlterreno::all();
        } else {
            $this->notificationcontrolterreno = collect(); // Colección vacía si el usuario tiene uno de los roles especificados
        }



         // Obtener las notificaciones de Datoscaminante solo si el usuario no es 'Caminante', 'Grupo Social' o 'Control de energia'
         if (!$this->loggedUser->hasRole('Caminante') && !$this->loggedUser->hasRole('Control de energia')) {
            $this->notificationcrearsubnormal = CrearSubnormal::all();
        } else {
            $this->notificationcrearsubnormal = collect(); // Colección vacía si el usuario tiene uno de los roles especificados
        }


         // Obtener las notificaciones de Datoscaminante solo si el usuario no es 'Caminante', 'Grupo Social' o 'Control de energia'
         if (!$this->loggedUser->hasRole('Caminante')&& !$this->loggedUser->hasRole('Grupo Social')) {
            $this->notificationdocumentsexits = DocumentsAcuerdoemsa::all();
        } else {
            $this->notificationdocumentsexits = collect(); // Colección vacía si el usuario tiene uno de los roles especificados
        }



         // Obtener las notificaciones de Datoscaminante solo si el usuario no es 'Caminante', 'Grupo Social' o 'Control de energia'
         if (!$this->loggedUser->hasRole('Caminante')) {
            $this->notificationcrearcodefactura = Invoicecode::all();
        } else {
            $this->notificationcrearcodefactura = collect(); // Colección vacía si el usuario tiene uno de los roles especificados
        }





       // Cargar las notificaciones leídas previamente por el usuario
       $this->cargarNotificacionesLeidas();

    }



    public function cargarNotificacionesLeidas()
    {
        $usuarioId = Auth::id();
        $this->notificacionesLeidas = UserNotification::where('user_id', $usuarioId)->pluck('notification_id')->toArray();

        $this->notificacionesLeidascontrolterreno = UserNotificationcodemacro::where('user_id', $usuarioId)->pluck('notificationcodemacro_id')->toArray();

        $this->notificacionesLeidascrearsubnormal = UserNotificationnewsubnormal::where('user_id', $usuarioId)->pluck('notinewsubnormal_id')->toArray();

        $this->notificacionesLeidasdocumentsexits = UserNotificationdocuments ::where('user_id', $usuarioId)->pluck('notificationdocuments_id')->toArray();

        $this->notificacionesLeidascodefactura = UserNotificationcodefactura::where('user_id', $usuarioId)->pluck('notificationcodefactura_id')->toArray();
    }

    public function marcarNotificacionComoLeidadatoscamiante($notificacionIddatoscaminante)
    {
        // Verificar si la notificación ya ha sido marcada como leída
        if (in_array($notificacionIddatoscaminante, $this->notificacionesLeidas)) {
            return; // No hacer nada si la notificación ya está marcada como leída
        }

        // Guardar la notificación como leída
        $usuarioId = Auth::id();
        UserNotification::create([
            'user_id' => $usuarioId,
            'notification_id' => $notificacionIddatoscaminante

        ]);


        // Recargar las notificaciones para reflejar los cambios
        $this->cargarNotificacionesLeidas();
        // Emitir un evento de Livewire para indicar que se ha marcado una notificación como leída

        $this->emit('notificacionLeidaActualizada');
        return;

    }

    public function marcarNotificacionComoLeidacodemacro($notificacionIdcodemacro)
    {


        // Verificar si la notificación ya ha sido marcada como leída
        if (in_array($notificacionIdcodemacro, $this->notificacionesLeidascontrolterreno)) {
            return; // No hacer nada si la notificación ya está marcada como leída
        }

        // Guardar la notificación como leída
        $usuarioId = Auth::id();
        UserNotificationcodemacro::create([
            'user_id' => $usuarioId,
            'notificationcodemacro_id' => $notificacionIdcodemacro
        ]);


        // Recargar las notificaciones para reflejar los cambios
        $this->cargarNotificacionesLeidas();

        $this->emit('notificacionLeidaActualizada');
        return;
    }

    public function marcarNotificacionComoLeidanewsubnormal($notificacionIdnewsubnormal)
    {

        // Verificar si la notificación ya ha sido marcada como leída
        if (in_array($notificacionIdnewsubnormal, $this->notificacionesLeidascrearsubnormal)) {
            return; // No hacer nada si la notificación ya está marcada como leída
        }

        // Guardar la notificación como leída
        $usuarioId = Auth::id();
        UserNotificationnewsubnormal::create([
            'user_id' => $usuarioId,
            'notinewsubnormal_id' => $notificacionIdnewsubnormal
        ]);




        // Recargar las notificaciones para reflejar los cambios
        $this->cargarNotificacionesLeidas();

        $this->emit('notificacionLeidaActualizada');
        return;
    }

    public function marcarNotificacionComoLeidagenerationdocuments($notificacionIddocuments)
    {

         // Verificar si la notificación ya ha sido marcada como leída
         if (in_array($notificacionIddocuments, $this->notificacionesLeidasdocumentsexits)) {
            return; // No hacer nada si la notificación ya está marcada como leída
        }

        // Guardar la notificación como leída
        $usuarioId = Auth::id();
        UserNotificationdocuments::create([
            'user_id' => $usuarioId,
            'notificationdocuments_id' => $notificacionIddocuments
        ]);


        // Recargar las notificaciones para reflejar los cambios
        $this->cargarNotificacionesLeidas();

        $this->emit('notificacionLeidaActualizada');
        return;
    }

    public function marcarNotificacionComoLeidagenerationcodefactura($notificacionIdcodefactura)
    {

        // Verificar si la notificación ya ha sido marcada como leída
        if (in_array($notificacionIdcodefactura, $this->notificacionesLeidascodefactura)) {
            return; // No hacer nada si la notificación ya está marcada como leída
        }

        // Guardar la notificación como leída
        $usuarioId = Auth::id();
        UserNotificationcodefactura::create([
            'user_id' => $usuarioId,
            'notificationcodefactura_id' => $notificacionIdcodefactura
        ]);



        // Recargar las notificaciones para reflejar los cambios
        $this->cargarNotificacionesLeidas();

        $this->emit('notificacionLeidaActualizada');
        return;
    }




    public function render()
    {
        $conteoNotificaciones = 0;
        $conteoNotificacionesControlTerreno = 0;
        $conteoNotificacionesSubnormal = 0;
        $conteoNotificacionesdocuments = 0;
        $conteoNotificacionescodefactura = 0;

        if (Auth::user()->hasRole('Centro de Inteligencia')) {
            $totalNotificaciones = Datoscaminante::count();
            $usuarioId = Auth::id();
            $notificacionesLeidas = UserNotification::where('user_id', $usuarioId)->pluck('notification_id')->toArray();
            $conteoNotificacionesLeidas = count($notificacionesLeidas);
            $conteoNotificaciones = $totalNotificaciones - $conteoNotificacionesLeidas;
        }

        if (Auth::user()->hasRole('Grupo Social')) {
            $totalNotificacionesControlTerreno = Controlterreno::count();
            $usuarioId = Auth::id();
            $notificacionesLeidasControlTerreno = UserNotificationcodemacro::where('user_id', $usuarioId)->pluck('notificationcodemacro_id')->toArray();
            $conteoNotificacionesLeidasControlTerreno = count($notificacionesLeidasControlTerreno);
            $conteoNotificacionesControlTerreno = $totalNotificacionesControlTerreno - $conteoNotificacionesLeidasControlTerreno;
        }

        if (Auth::user()->hasRole('Grupo Social') || Auth::user()->hasRole('Centro de Inteligencia')) {
            $totalNotificacionesSubnormal = CrearSubnormal::count();
            $usuarioId = Auth::id();
            $notificacionesLeidasSubnormal = UserNotificationnewsubnormal::where('user_id', $usuarioId)->pluck('notinewsubnormal_id')->toArray();
            $conteoNotificacionesLeidasSubnormal = count($notificacionesLeidasSubnormal);
            $conteoNotificacionesSubnormal = $totalNotificacionesSubnormal - $conteoNotificacionesLeidasSubnormal;
        }

        if (Auth::user()->hasRole('Control de energia') || Auth::user()->hasRole('Centro de Inteligencia')) {
            $totalNotificacionesdocuments = DocumentsAcuerdoemsa::count();
            $usuarioId = Auth::id();
            $notificacionesLeidasdocuments = UserNotificationdocuments::where('user_id', $usuarioId)->pluck('notificationdocuments_id')->toArray();
            $conteoNotificacionesLeidasdocuments = count($notificacionesLeidasdocuments);
            $conteoNotificacionesdocuments = $totalNotificacionesdocuments - $conteoNotificacionesLeidasdocuments;
        }

        if (Auth::user()->hasRole('Grupo Social') || Auth::user()->hasRole('Centro de Inteligencia')|| Auth::user()->hasRole('Control de energia')) {
            $totalNotificacionescodefactura = Invoicecode::count();
            $usuarioId = Auth::id();
            $notificacionesLeidascodefactura = UserNotificationcodefactura::where('user_id', $usuarioId)->pluck('notificationcodefactura_id')->toArray();
            $conteoNotificacionesLeidascodefactura= count($notificacionesLeidascodefactura);
            $conteoNotificacionescodefactura = $totalNotificacionescodefactura - $conteoNotificacionesLeidascodefactura;
        }

        // Sumar los conteos
        $conteoTotal = $conteoNotificaciones + $conteoNotificacionesControlTerreno + $conteoNotificacionesSubnormal + $conteoNotificacionesdocuments + $conteoNotificacionescodefactura;

        return view('livewire.wordkin.notifications', [
            'conteoNotificaciones' => $conteoNotificaciones,
            'conteoNotificacionesControlTerreno' => $conteoNotificacionesControlTerreno,
            'conteoNotificacionesSubnormal' => $conteoNotificacionesSubnormal,
            'conteoNotificacionesdocuments' => $conteoNotificacionesdocuments,
            'conteoNotificacionescodefactura' => $conteoNotificacionescodefactura,
            'conteoTotal' => $conteoTotal, // Nuevo contador que suma todos los conteos
        ]);


    }



}




