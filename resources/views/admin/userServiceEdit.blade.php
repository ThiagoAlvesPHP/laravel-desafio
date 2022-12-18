@extends('layout.app-admin')

<script>
    let cartInit = [];
</script>

@section('content')
    <section class="block userservice">
        <h1 class="title">{{__('Service Edit')}}</h1>

        <form action="{{route('userServiceUpdate', [$id])}}" method="POST" class="userservice__form">
            @csrf

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

            <x-site.select required=true name="car_id" label="My Cars" type="modelService" :data=$cars :params=$params />

            <x-site.input type="date" required=true name="date" label="Data" placeholder="Data da Manutenção" :params=$service />

            <div class="userservice__select_service">
                <table class="userservice__table">
                    <thead>
                        <tr>
                            <th>{{__('ID')}}</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Price')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                    </thead>
                    @if ($services)
                        @foreach ($services as $item)
                            @if ($item->checked)
                                @php
                                    $amount += $item->price
                                @endphp
                            @endif
                            <tbody>
                                <tr>
                                    <td><p>{{$item->id}}</p></td>
                                    <td><p>{{$item->name}}</p></td>
                                    <td>
                                        <p>R${{number_format($item->price, 2, ',', '.')}}</p>
                                        <input type="hidden" value="{{$item->price}}" class="userservice__price">
                                    </td>
                                    <td><p><input type="checkbox" {{($item->checked)?'checked':''}} name="service_id[]" class="service_id" id="service_id{{$item->id}}" value="{{$item->id}}" /></p></td>
                                </tr>
                            </tbody>
                            @if ($item->checked)
                                <script>
                                    cartInit.push({'service_id':{{$item->id}}, 'price':{{$item->price}}});
                                </script>
                            @endif
                        @endforeach
                    @endif
                </table>

                <p class="userservice__amount">
                    <span class="userservice__text">{{__('Amount:')}}</span>
                    <span class="userservice__amountprice">R$ {{number_format($amount, 2, ',', '.')}}</span>
                </p>

                <div class="userservice__action">
                    <button class="btn btn-success">{{__('Update')}}</button>
                </div>
            </div>
        </form>
    </section>
@endsection

@if ($status)
    <script>
        if(sessionStorage.getItem('cart')){
            sessionStorage.removeItem('cart')
        }
    </script>
@endif
<link rel="stylesheet" href="{{asset('assets/css/page/userservice.css')}}">
<script defer src="{{asset('assets/js/custom/userserviceedit.js')}}"></script>
