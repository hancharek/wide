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
                    <p class="text-center text-3xl">Confirme sua senha</p>

                    <form class="flex flex-col pt-3 md:pt-8" method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <p class="leading-normal text-gray-500">
                            {{ __('Confirme sua senha para continuar') }}
                        </p>

                        <div class="flex flex-col pt-4">
                            <label for="password" class="text-lg">
                                {{ __('Sua Senha') }}:
                            </label>

                            <input id="password" type="password"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror" name="password"
                                required autocomplete="new-password">

                            @error('password')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="flex flex-wrap justify-center items-center space-y-6 pb-6 sm:pb-10 sm:space-y-0 sm:justify-between">
                            <button type="submit"
                            class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700 sm:w-auto sm:px-4 sm:order-1">
                                {{ __('Confirme sua senha') }}
                            </button>

                            @if (Route::has('password.request'))
                            <a class="mt-4 text-xs text-blue-500 hover:text-blue-700 whitespace-no-wrap no-underline hover:underline sm:text-sm sm:order-0 sm:m-0"
                                href="{{ route('password.request') }}">
                                {{ __('Esqueceu sua senha?') }}
                            </a>
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
