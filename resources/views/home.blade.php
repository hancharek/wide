@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10">
    <div class="w-full sm:px-6">

        @if (session('status'))
            <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                Dashboard
            </header>

            <div class="w-full p-6">
                @if (session("success"))
                    <div class="container mx-auto mt-5">
                        <div class="bg-teal-100 border-t-4 border-teal-500">
                            <div class="flex">
                                <div class="py-1">
                                    <svg class="fill-current h6 w6-6"></svg>
                                </div>
                                <div>
                                    <p class="font-bold">{{ __("Nova mensagem")}}</p>
                                    <p class="text-sm">{{ session("success") }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="container mx-auto px-4">
                    @yield('content')
                </div>
            </div>
        </section>
    </div>
</main>
@endsection
