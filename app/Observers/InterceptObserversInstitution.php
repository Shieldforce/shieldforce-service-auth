<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InterceptObserversInstitution
 * @package App\Observers
 */
class InterceptObserversInstitution
{

    /**
     * @param $class
     */
    public function creating(Model $model)
    {
        if(isset(auth()->user()->institution->id))
        {
            //TODO::Mudar para instituição do usuário logado
            $model->setAttribute('institution_id', 1);
        }
    }
}
