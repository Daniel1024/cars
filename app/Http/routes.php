<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Cars\Models\Car;
use Cars\Models\Feature;
use Cars\Models\MakeYear;

Route::get('/', function () {
    return view('welcome');
});

Route::get('bootstrap', function () {
    return view('bootstrap');
});

Route::get('dropdowns', function () {
    return view('components/dropdowns');
});

Route::get('makeyears/{make_id}', function ($make_id) {
    $years = MakeYear::where('make_id', $make_id)
        ->select('id as value', 'year as text')
        ->orderBy('year', 'DESC')
        ->get()
        ->toArray();

    array_unshift($years, ['value'=>'', 'text'=>'Select value']);

    return $years;
});

Route::get('models/{makeyear_id}', function ($makeyear_id) {
    $models = \Cars\Models\Model::where('makeyear_id', $makeyear_id)
        ->select('id as value', 'name as text')
        ->orderBy('name', 'ASC')
        ->get()
        ->toArray();

    array_unshift($models, ['value'=>'', 'text'=>'Select value']);

    return $models;
});

Route::get('features', function () {

    $car = Car::first();

    $features = Feature::orderBy('name', 'ASC')
        ->lists('name', 'id')
        ->toArray();

    return view('components.features', compact('features', 'car'));
});

Route::post('features', function () {

    $features = Request::get('features');

    Feature::addNewFeatrures($features);

    $car = Car::first();
    $car->saveFeatures($features);

    return redirect()->to('features');

});