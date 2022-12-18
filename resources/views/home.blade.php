@extends('layout.app-site')

<link rel="stylesheet" href="{{asset('assets/css/page/home.css')}}">

@section('content')
    <section class="block home">
        <div class="home__content">
            <h1 class="home__title">{{__('Login')}}</h1>
            <hr>
            <form action="{{route('auth')}}" method="POST" class="home__form">
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

                <x-site.input type="email" required=true name="email" label="E-mail" placeholder="E-mail" />
                <x-site.input type="password" required=true name="password" label="Senha" placeholder="Digite sua senha" />

                <button class="btn btn-success">{{__('Login')}}</button>
            </form>

            <hr>

            <a href="{{route('register')}}" class="link">{{__('Register')}}</a>
        </div>
    </section>
@endsection
