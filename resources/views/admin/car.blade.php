@extends('layout.app-admin')

@section('content')
    <section class="block car">
        <h1 class="title">{{__('Car Register')}}</h1>

        <form action="{{route('carRegister')}}" method="POST" class="car__form">
            @csrf
            {{-- erros de validação --}}
            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <x-site.alert class="alert-danger">
                        {{ $error }}
                    </x-site.alert>
                @endforeach
            @endif
            @if (session('status'))
                <x-site.alert class="alert-danger">
                    {{ __(session('status')) }}
                </x-site.alert>
            @endif
            <x-site.select required=true name="brand_id" label="Marca" :data=$brands />
            <x-site.select required=true name="model_id" label="Modelo" />
            <x-site.input type="number" required=true name="year" label="Ano" placeholder="Ano no veículo" />
            <button class="btn btn-success">{{__('Register')}}</button>
        </form>

        <hr>

        <div class="car__list">
            @if ($list)
                <div class="car__titles">
                    <p class="title">{{__('Brand')}}</p>
                    <p class="title">{{__('Model')}}</p>
                    <p class="title">{{__('Year')}}</p>
                    <p class="title">{{__('Action')}}</p>
                </div>
                @foreach ($list as $item)
                    <div class="car__card">
                        <div class="car__brand">{{$item->brand}}</div>
                        <div class="car__model">{{$item->model}}</div>
                        <div class="car__year">{{$item->year}}</div>
                        <div class="car__action">
                            <a href="{{route('carEdit', $item->id)}}" class="car__edit fas fa-edit"></a>
                            <a href="{{route('carDelete', $item->id)}}" class="car__delete fas fa-trash-alt"></a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>
@endsection
<link rel="stylesheet" href="{{asset('assets/css/page/car.css')}}">
<script>
    var _url = "{{route('apiModel')}}";
</script>
<script defer src="{{asset('assets/js/custom/car.js')}}"></script>
