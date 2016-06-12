<?php

namespace Cars\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    //
    public $fillable = ['name'];

    public static function filterNewFeatures($features)
    {
        $features = array_filter($features, function ($value) {
            return !is_numeric($value); //verifica que no sean numeros
        });

        $features = array_filter($features, function ($value) {
            return strlen($value) >= 2; //verifica que sean mayor que dos caracteres
        });

        array_walk($features, 'trim'); //elimina los espacios

        $features = array_unique($features); //Elimina los repetido

        $existingFeatures= static::whereIn('name', $features)
            ->lists('name')
            ->toArray(); //trae de la base de datos features que ya tengamos guardados

        return array_diff($features, $existingFeatures); //devuelve los Features nuevos
    }
    
    public static function addNewFeatrures($features)
    {
        $newFeatures = static::filterNewFeatures($features);

        foreach ($newFeatures as $feature) {
            static::create(['name'=>$feature]);
        }
    }
}
