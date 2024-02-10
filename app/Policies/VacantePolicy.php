<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vacante;
use Illuminate\Auth\Access\Response;

class VacantePolicy
{
    //Determina si un usuario puede ver un modelo
    //Hay policies que no se les pasa una instancia, de un registro en la base de datos sino, que se le pasa un modelo completo para prevenir
    //el acceso a ese modelo
    public function viewAny(User $user): bool
    {
        //
        return $user->rol === 2;
    }
    //Determina si un usuario puede crear modelos, en este caso Vacantes
    //Entonces, esta política específica permite la creación de modelos (vacantes)
    //solo si el campo rol del usuario es igual a 2. Si esta condición se cumple,
    //la función create devuelve true, lo que indica que el usuario tiene permisos para crear vacantes.
    //Si no se cumple la condición, la función devuelve false, indicando que el usuario no tiene permisos para realizar la acción.
    public function create(User $user) : bool
    {
        return $user->rol === 2;
    }
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Vacante $vacante): bool
    {
        //
        return $user->id === $vacante->user_id;
    }
}
