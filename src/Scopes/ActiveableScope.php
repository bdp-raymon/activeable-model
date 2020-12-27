<?php


namespace Alish\ActiveableModel\Scopes;

use Alish\ActiveableModel\Models\ActiveableModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ActiveableScope implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
        $builder->addSelect([
            'is_active' => ActiveableModel::select('is_active')
                ->whereColumn('object_id', $model->getTable() . ".id")
                ->where('object_type', get_class($model))
                ->latest('created_at')
                ->latest('id')
                ->limit(1)
        ]);
    }


}
