<?php

namespace Alish\ActiveableModel;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Alish\ActiveableModel\Skeleton\SkeletonClass
 */
class ActiveableModelFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'activeable-model';
    }
}
