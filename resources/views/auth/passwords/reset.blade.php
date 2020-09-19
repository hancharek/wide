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
                    <p class="text-center text-3xl">Tracar sua senha</p>

                    <form class="flex flex-col pt-3 md:pt-8" method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="flex flex-col pt-4">
                            <label for="email" class="text-lg">
                                {{ __('Seu e-mail') }}:
                            </label>

                            <input id="email" type="email"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" name="email"
                                value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <p class="text-red-500 text-xs italic mt-4">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="flex flex-col pt-4">
                            <label for="password" class="text-lg">
                                {{ __('Sua senha') }}:
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

                        <div class="flex flex-col pt-4">
                            <label for="password-confirm" class="text-lg">
                                {{ __('Confirme sua senha') }}:
                            </label>

                            <input id="password-confirm" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="flex flex-wrap pb-8 sm:pb-10">
                            <button type="submit"
                            class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700 sm:py-4">
                                {{ __('Resetar a sua senha') }}
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</main>
@endsection
