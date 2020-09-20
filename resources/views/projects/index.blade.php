@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10 md:mb-10">
  <div class="w-full sm:px-6">

      @if (session('status'))
          <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
              {{ session('status') }}
          </div>
      @endif

      <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

        <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
          Projetos
        </header>

        <div class="w-full p-6">
          <div class="flex justify-center flex-wrap bg-gray-200 p-4 mt-5">
            <div class="text-center">
              <h1 class="mb-5">{{ __("Lista de Projetos") }}</h1>
              <a href="{{ route("projects.create")}}" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded ">
                {{ __("Adicionar Projeto") }}
              </a>                  
            </div>
          </div>
        </div>
        <table class="w-full whitespace-no-wrap">
          <thead>
            <tr
              class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
            >
              <th class="px-4 py-3">{{ __("Nome") }}</th>
              <th class="px-4 py-3">{{ __("Autor") }}</th>
              <th class="px-4 py-3">{{ __("Criado em") }}</th>
              <th class="px-4 py-3">{{ __("Ação") }}</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
            @forelse ($projects as $project)
              <tr class="text-gray-700 dark:text-gray-400">
                <td class="px-4 py-3">
                  <p class="font-semibold">{{ $project->name }}</p>
                </td>
                <td class="px-4 py-3">
                  <p class="font-semibold">{{ $project->user->name }}</p>
                </td>
                <td class="px-4 py-3 text-sm">
                  {{ date_format($project->created_at, "d/m/Y") }}
                </td>
                <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                  <a href="{{ route("projects.edit", ["project" => $project]) }}" class="text-indigo-600 hover:text-indigo-900">{{ __("Editar")}}</a>
                  <a href="#" class="text-red-600 hover:text-red-900"
                    onclick="event.preventDefault();
                    document.getElementById('delete-project-{{ $project->id }}-form').submit();"
                  >{{ __("Deletar")}}</a>
                <form id="delete-project-{{ $project->id }}-form" action="{{ route("projects.destroy", ["project" => $project])}}" method="POST" class="hidden">
                    @method("DELETE")
                    @csrf
                  </form>
                </td>
              </tr>  
            @empty
                <tr class="text-gray-700 dark:text-gray-400">
                  <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                    <p class="font-semibold">{{ __(" Não foi feito nenhum projeto") }}</p>
                    <span class="font-semibold">{{ __("Não existe informação em nosa base de dados!") }}</span>
                  </td>
                </tr>
            @endforelse
          </tbody>
        </table>
        <div class="pag-wide px-8 py-2 text-xs font-semibold tracking-wide text-gray-500 dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
          @if ($projects->count())
              <div class="mt-3">
                {{ $projects->links() }}
              </div>
          @endif   
        </div>
      </section>
  </div>
</main>
@endsection

