<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use App\Models\ModelBrand;
use App\Models\ServiceList;
use App\Models\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $array = [];
        $list = UserService::where('user_id', Auth::user()->id)->where('date', '>=', date('Y-m-d'))->where('date', '<=', date('Y-m-d', strtotime("+7 days",strtotime(date('Y-m-d')))))->orderBy('date')->get();

        foreach ($list as $key => $value) {
            $car = Car::find($value->car_id);
            $list[$key]['brand'] = Brand::find($car->brand_id)->name;
            $list[$key]['model'] = ModelBrand::find($car->model_id)->name;
            $list[$key]['price'] = ServiceList::where('user_service_id', $value->id)->sum('price');
            $list[$key]['year'] = $car->year;
        }

        $array['list'] = $list;

        return view('admin.home', $array);
    }
}
