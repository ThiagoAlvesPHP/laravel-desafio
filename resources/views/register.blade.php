@extends('layout.app-site')

<link rel="stylesheet" href="{{asset('assets/css/page/home.css')}}">

@section('content')
    <section class="block home">
        <div class="home__content">
            <h1 class="home__title">{{__('Register')}}</h1>
            <hr>
            <form action="{{route('actionRegister')}}" method="POST" class="home__form">
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

                <x-site.input type="text" required=true name="name" label="Name" placeholder="Name" />
                <x-site.input type="email" required=true name="email" label="E-mail" placeholder="E-mail" />
                <x-site.input type="password" required=true name="password" label="Senha" placeholder="Digite sua senha" />

                <button class="btn btn-success">{{__('Register')}}</button>
            </form>

            <hr>

            <a href="{{route('login')}}" class="link">{{__('Login')}}</a>
        </div>
    </section>
@endsection
