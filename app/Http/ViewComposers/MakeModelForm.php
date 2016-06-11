<?php
/**
 * Created by PhpStorm.
 * User: danie
 * Date: 11/06/2016
 * Time: 01:58 PM
 */

namespace Cars\Http\ViewComposers;


use Illuminate\Contracts\View\View;
use Cars\Models\Make;
use Cars\Models\MakeYear;
use Cars\Models\Model;
use Illuminate\Support\Facades\Request;

class MakeModelForm
{

    public function compose(View $view)
    {
        $makeForm = Request::only('make_id', 'makeyear_id', 'model_id');

        $makes = Make::orderBy('name', 'ASC')
            ->lists('name', 'id')
            ->toArray();
        $makeYears = $models = array();

        if ($makeForm['make_id'] != null) {
            $makeYears = MakeYear::where('make_id', $makeForm['make_id'])
                ->orderBy('year', 'ASC')
                ->lists('year', 'id')
                ->toArray();
            if ($makeForm['makeyear_id'] != null) {
                $models = Model::where('makeyear_id', $makeForm['makeyear_id'])
                    ->orderBy('name', 'ASC')
                    ->lists('name', 'id')
                    ->toArray();
            }
        }

        $view->with(compact('makeForm', 'makes', 'makeYears', 'models'));
    }

}