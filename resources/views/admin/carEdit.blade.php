@extends('layout.app-admin')

@section('content')
    <section class="block car">
        <h1 class="title">{{__('Car Edit')}}</h1>

        <form action="{{route('carUpdate', $car->id)}}" method="POST" class="car__form">
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
            <x-site.select required=true name="brand_id" label="Marca" type="brand" :data=$brands :params=$car />
            <x-site.select required=true name="model_id" label="Modelo" type="model" :data=$models :params=$car />
            <x-site.input type="number" required=true name="year" label="Ano" placeholder="Ano no veículo" :params=$car />
            <button class="btn btn-success">{{__('Update')}}</button>
        </form>
    </section>
@endsection

<link rel="stylesheet" href="{{asset('assets/css/page/car.css')}}">
<script>
    var _url = "{{route('apiModel')}}";
</script>
<script defer src="{{asset('assets/js/custom/car.js')}}"></script>
