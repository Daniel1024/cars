<?php

namespace Cars\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    //

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'car_feature');
    }

    public function getFeatureIdsAttribute()
    {
        return $this
            ->features()
            ->lists('feature_id')
            ->toArray();
    }

    public function saveFeatures(Array $features)
    {
        //validacion de datos para el servidor
        $features = Feature::whereIn('id', $features)
            ->orwhereIn('name', $features)
            ->get();
        $this->features()->sync($features);
    }
}
