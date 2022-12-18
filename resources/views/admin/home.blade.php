@extends('layout.app-admin')

@section('content')
    <section class="block dashboard">
        <h1 class="title">{{__('Dashboard')}} - {{__('Hi')}} {{Auth::user()->name}}!</h1>

        <div class="car__list">
            @if ($list)
                <div class="car__titles">
                    <p class="title">{{__('Brand')}}</p>
                    <p class="title">{{__('Model')}}</p>
                    <p class="title">{{__('Date')}}</p>
                    <p class="title">{{__('Price')}}</p>
                    <p class="title">{{__('Action')}}</p>
                </div>
                @foreach ($list as $item)
                    <div class="car__card">
                        <div class="car__brand">{{$item->brand}}</div>
                        <div class="car__model">{{$item->model}}</div>
                        <div class="car__date">{{date('d/m/Y', strtotime($item->date))}}</div>
                        <div class="car__price">R${{number_format($item->price, 2, ',', '.')}}</div>
                        <div class="car__action">
                            <a href="{{route('userServiceEdit', $item->id)}}" class="car__edit fas fa-edit"></a>
                            <a href="{{route('userServiceDelete', $item->id)}}" class="car__delete fas fa-trash-alt"></a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>
@endsection

<link rel="stylesheet" href="{{asset('assets/css/page/car.css')}}">
