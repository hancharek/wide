@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10 md:mb-10">
  <div class="w-full sm:px-6">
      {{-- @if (!errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
          @foreach ($errors->all() as $error)
            @if($error = 'validation.url')
              <span class="block sm:inline">Sua é URL Inválida (Modelo de exemplo: http://www.seusite.com ou https://www.seusite.com.br )</span>
            @else 
              <span class="block sm:inline">{{ $error }}</span>  
            @endif
          @endforeach
        </div>
      @endif --}}

      <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

        <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
            {{ is_null($urls) ? "Adicionar" : "Editar" }}
        </header>
        <form id='form-retrieve' enctype="multipart/form-data"
          action='{{ is_null($urls) ? route('urls.store') : route('urls.update', $urls->id) }}' method='post'>
          @if(!is_null($urls))
            @method('PUT')
          @endif
            @csrf
          <div class="flex flex-col pt-4">
            <label for="url" class="text-lg">
                {{ __('Urls') }}:
            </label>

            <input id="url" name="url" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
              value="{{ is_null($urls) ? old('url') : $urls->url }}" required autofocus>
          </div>

          <div class="flex flex-col pt-4">
            <label for="nome_site" class="text-lg">
                {{ __('Descrição') }}:
            </label>

            <input id="nome_site" name="nome_site" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
              value="{{  is_null($urls) ? old('nome_site') : $urls->nome_site }}" required autofocus>
          </div>

          <div class="flex flex-col pt-4">
            <button class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700 sm:py-4">
                {{ __('Salvar') }}
            </button>

            
            <button class="bg-teal-600 hover:bg-teal-900 w-full select-none font-bold text-white md:mt-10 no-underline text-base leading-normal whitespace-no-wrap p-3 rounded-lg sm:py-4" href="{{ route('urls.create') }}">
              <a href="javascript:history.back()">
                {{ __('Voltar') }}
              </a>
            </button>
            <button class="bg-teal-600 hover:bg-teal-900 w-full select-none font-bold text-white md:mt-10 no-underline text-base leading-normal whitespace-no-wrap p-3 rounded-lg sm:py-4" href="{{ route('urls.create') }}">
              <a href="{{ route('urls.index') }}">
                {{ __('Home') }}
              </a>
            </button>
            
          </div>
        </form>
      </section>
  </div>
</main>
@endsection