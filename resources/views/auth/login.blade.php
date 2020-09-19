@extends('layouts.applogin')

@section('content')
<main class="w-full flex flex-wrap">
    <div class="w-full md:w-1/2 flex flex-col">
        <div class="w-full">
            <section class="flex flex-col break-words bg-white">
                <div class="flex justify-center md:justify-start pt-5 md:pl-5 md:-mb-4">
                    <a href="#" class="background-wide text-white font-bold text-xl p-4">WIDE</a>
                </div>
                
                <div class="flex flex-col justify-center md:justify-start my-auto md:pt-0 px-4 md:px-4 lg:px-10">
                    <p class="text-center text-3xl">Bem-vindo</p>

                    <form class="flex flex-col pt-3 md:pt-8" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="flex flex-col pt-4">
                            <label for="email" class="text-lg">
                                {{ __('Seu e-mail') }}:
                            </label>

                            <input id="email" type="email"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="flex flex-col pt-4">
                            <label for="password" class="text-lg">
                                {{ __('Sua Senha') }}:
                            </label>

                            <input id="password" type="password"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror" name="password"
                                required>

                            @error('password')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="flex items-center mt-3 mb-3">
                            <label class="inline-flex items-center text-sm text-gray-700" for="remember">
                                <input type="checkbox" name="remember" id="remember" class="form-checkbox"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <span class="ml-2">{{ __('Lembrar-me') }}</span>
                            </label>

                            @if (Route::has('password.request'))
                            <a class="text-sm text-blue-500 hover:text-blue-700 whitespace-no-wrap no-underline ml-auto"
                                href="{{ route('password.request') }}">
                                {{ __('Esqueceu sua senha') }}
                            </a>
                            @endif
                        </div>

                        <div class="flex flex-wrap">
                            <button type="submit"
                            class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700 sm:py-4">
                                {{ __('Logar') }}
                            </button>

                            @if (Route::has('register'))
                            <p class="w-full text-xs text-center text-gray-700 my-6 sm:text-sm sm:my-8">
                                {{ __("Você ainda não tem uma conta?") }}
                                <a class="text-blue-500 hover:text-blue-700 no-underline" href="{{ route('register') }}">
                                    {{ __('Cadastar') }}
                                </a>
                            </p>
                            @endif
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
    <div class="w-1/2 shadow-2xl">
        <img class="object-cover w-full h-screen hidden md:block" src="https://source.unsplash.com/random">
    </div>
</main>
@endsection
