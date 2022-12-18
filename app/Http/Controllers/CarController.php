<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use App\Models\ModelBrand;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function index()
    {
        $array = [];

        $array['brands'] = Brand::all();
        $list = Car::where('user_id', Auth::user()->id)->get();

        foreach ($list as $key => $value) {
            $list[$key]['brand'] = Brand::find($value->brand_id)->name;
            $list[$key]['model'] = ModelBrand::find($value->model_id)->name;
        }

        $array['list'] = $list;

        return view('admin.car', $array);
    }
    /**
     * register car
     */
    public function register(Request $request)
    {
        $rulesFormOne = [
            'brand_id'      => 'required|min:1',
            'model_id'     => 'required|min:1',
            'year'     => 'required|min:4'
        ];

        $validator = Validator::make($request->all(), $rulesFormOne);

        if($validator->fails()) {
            return redirect()->route('car')->withErrors($validator)->withInput();
        }

        $req = $request->only(['brand_id', 'model_id', 'year']);
        $req['user_id'] = Auth::user()->id;

        Car::create($req);
        return redirect()->route('car')->with('status', 'Registration successfully completed!');
    }

    /**
     * delete car
     */
    public function delete($id)
    {
        Car::find($id)->delete();
        return redirect()->route('car')->with('status', 'Deleted successfully completed!');
    }
    /**
     * page edit
     */
    public function edit($id)
    {
        $array = [];
        $array['brands'] = Brand::all();
        $array['car'] = Car::find($id);
        $array['models'] = ModelBrand::where('brand_id', $array['car']->brand_id)->get();

        if (Auth::user()->id != $array['car']->user_id) {
            return redirect()->route('car')->with('status', 'Car not user!');
        }

        return view('admin.carEdit', $array);
    }
    /**
     * update car
     */
    public function update($id, Request $request)
    {
        if ($request->method() != "POST") {
            return redirect()->route('carEdit', [$id])->with('status', 'Method invalid!');
        }

        $car = Car::find($id);

        if (Auth::user()->id != $car->user_id) {
            return redirect()->route('carEdit', [$id])->with('status', 'Car not user!');
        }

        $rulesFormOne = [
            'brand_id'      => 'required|min:1',
            'model_id'     => 'required|min:1',
            'year'     => 'required|min:4'
        ];

        $validator = Validator::make($request->all(), $rulesFormOne);

        if($validator->fails()) {
            return redirect()->route('car')->withErrors($validator)->withInput();
        }

        $req = $request->only(['brand_id', 'model_id', 'year']);
        $car->update($req);
        return redirect()->route('carEdit', [$id])->with('status', 'Registration updated successfully!');
    }

    /**
     * ajax get model
     */
    public function getAjaxModelAll(Request $request)
    {
        $array = [
            "error" => true
        ];

        if($request->input('brand_id')) {
            $array['list'] = ModelBrand::where("brand_id", $request->input('brand_id'))->get();
            $array['error'] = false;
        }

        return $array;
    }
}
