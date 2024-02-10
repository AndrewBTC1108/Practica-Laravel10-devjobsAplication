<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    //Solo consta de un metodo para poder acceder solamente a algo en la BS
    public function __invoke(Request $request)
    {
        //No traera las Notificaciones que el usuario aun no ha leido
        $notificaciones = auth()->user()->unreadNotifications;

        //Limpiar Notificiaciones
        auth()->user()->unreadNotifications->markAsRead();

        //retornamos una vista
        return view('notificaciones.index', [
            'notificaciones' => $notificaciones
        ]);

    }
}
