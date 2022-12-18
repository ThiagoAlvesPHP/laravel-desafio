<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use App\Models\ModelBrand;
use App\Models\Service;
use App\Models\ServiceList;
use App\Models\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserServiceController extends Controller
{
    public function index(Request $request)
    {
        $array = [];

        $array['status'] = (!empty($request->input('status')))?true:false;

        $cars = Car::where('user_id', Auth::user()->id)->get();
        foreach ($cars as $key => $value) {
            $cars[$key]['name'] = ModelBrand::find($value->model_id)->name;
        }
        $array['cars'] = $cars;
        $array['services'] = Service::all();

        return view('admin.userService', $array);
    }
    /**
     * register
     */
    public function register(Request $request)
    {
        $user_services = [
            "user_id" => Auth::user()->id,
            "car_id" => $request->input('car_id'),
            "date" => $request->input('date')
        ];
        $rulesFormOne = [
            'user_id'      => 'required|min:1',
            'car_id'     => 'required|min:1',
            'date'     => 'required'
        ];

        if($request->input('date') < date('Y-m-d')) {
            return redirect()->route('userService')->with('status', 'Date invalid!');
        }

        $validator = Validator::make($user_services, $rulesFormOne);

        if($validator->fails()) {
            return redirect()->route('userService')->withErrors($validator)->withInput();
        }

        $find = UserService::create($user_services);

        $service_list = [];
        foreach ($request->input('service_id') as $key => $value) {
            $service_list[$key]['service_id'] = $value;
            $service_list[$key]['user_service_id'] = $find->id;
            $service_list[$key]['price'] = Service::find($value)->price;
        }

        foreach ($service_list as $key => $value) {
            ServiceList::create($value);
        }

        return redirect()->route('userService', ["status" => true])->with('status', 'Registration successfully completed!');
    }

    /**
     * List Services
     */
    public function list()
    {
        $array = [];
        $list = UserService::where('user_id', Auth::user()->id)->orderBy('date')->get();

        foreach ($list as $key => $value) {
            $car = Car::find($value->car_id);
            $list[$key]['brand'] = Brand::find($car->brand_id)->name;
            $list[$key]['model'] = ModelBrand::find($car->model_id)->name;
            $list[$key]['price'] = ServiceList::where('user_service_id', $value->id)->sum('price');
            $list[$key]['year'] = $car->year;
        }

        $array['list'] = $list;
        return view('admin.userServiceList', $array);
    }

    /**
     * delete
     */
    public function delete($id)
    {
        if (ServiceList::where('user_service_id', $id)) {
            ServiceList::where('user_service_id', $id)->delete();
        }
        if (UserService::find($id)) {
            UserService::find($id)->delete();
        }
        return redirect()->route('userServiceList')->with('status', 'Deleted successfully completed!');
    }

    /**
     * edit
     */
    public function edit($id, Request $request)
    {
        $array = [];

        if(!UserService::find($id)) {
            return redirect()->route('userServiceList')->with('status', 'Service invalid!');
        }
        if (Auth::user()->id != UserService::find($id)->user_id) {
            return redirect()->route('userServiceList', [$id])->with('status', 'Service not user!');
        }

        $user_services = UserService::find($id);
        $service_list = ServiceList::where('user_service_id', $user_services->id)->get();

        $params = [];
        $in = [];
        foreach ($service_list as $key => $value) {
            $in[] = $value->service_id;
            $params[] = Service::find($value->service_id);
        }
        foreach ($params as $key => $value) {
            $params[$key]['checked'] = true;
        }
        $service_listIn = Service::whereNotIn('id', $in)->get();
        foreach ($service_listIn as $key => $value) {
            $params[] = $value;
        }

        $array['status'] = (!empty($request->input('status')))?true:false;
        $array['params'] = Car::find($user_services->car_id);

        $cars = Car::where('user_id', Auth::user()->id)->get();

        foreach ($cars as $key => $value) {
            $cars[$key]['name'] = ModelBrand::find($value->model_id)->name;
        }

        $array['service'] = UserService::find($id);
        $array['cars'] = $cars;
        $array['services'] = array_unique($params);
        $array['amount'] = 0;
        $array['id'] = $id;

        return view('admin.userServiceEdit', $array);
    }

    /**
     * update
     */
    public function update($id, Request $request)
    {
        if ($request->method() != "POST") {
            return redirect()->route('userServiceEdit', [$id])->with('status', 'Method invalid!');
        }
        $service = UserService::find($id);

        if(!$service) {
            return redirect()->route('userServiceList')->with('status', 'Service invalid!');
        }
        if (Auth::user()->id != UserService::find($id)->user_id) {
            return redirect()->route('userServiceList', [$id])->with('status', 'Service not user!');
        }

        $user_services = [
            "car_id" => $request->input('car_id'),
            "date" => $request->input('date')
        ];
        $rulesFormOne = [
            'car_id'     => 'required|min:1',
            'date'     => 'required'
        ];

        $validator = Validator::make($user_services, $rulesFormOne);

        if($validator->fails()) {
            return redirect()->route('userServiceEdit', [$id])->withErrors($validator)->withInput();
        }

        $service->update($user_services);

        $service_list = [];
        foreach ($request->input('service_id') as $key => $value) {
            $service_list[$key]['user_service_id'] = $id;
            $service_list[$key]['service_id'] = $value;
            $service_list[$key]['price'] = Service::find($value)->price;
        }

        ServiceList::where('user_service_id', $id)->delete();

        foreach ($service_list as $key => $value) {
            ServiceList::create($value);
        }

        return redirect()->route('userServiceEdit', [$id, "status" => true])->with('status', 'Registration updated successfully!');
    }
}
