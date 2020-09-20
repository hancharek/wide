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
          Urls
        </header>
        <div class="w-full p-6">
          <form>
            <div class="flex flex-col pt-4">
              <label for="url" class="text-lg">
                  {{ __('Endereço da Url') }}:
              </label>

              <input id="url" name="url" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
                value="{{ old('url') }}" required autofocus>
            </div>

            <div class="flex flex-col pt-4">
              <label for="nome_site" class="text-lg">
                  {{ __('Descrição') }}:
              </label>

              <input id="nome_site" name="nome_site" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline"
                value="{{ old('nome_site') }}" required autofocus>
            </div>

            <div class="flex flex-col pt-4">
              <button class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700 sm:py-4">
                  {{ __('Buscar') }}
              </button>

              
                  <a class="bg-teal-600 hover:bg-teal-900 text-center w-full select-none font-bold text-white md:mt-10 no-underline text-base leading-normal whitespace-no-wrap p-3 rounded-lg sm:py-4" href="{{ route('urls.create') }}">
                      {{ __('Nova') }}
                  </a>
              
            </div>
          </form>
        </div>
          <header class="font-semibold text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
            Lista de Urls Cadastradas
          </header>
          <table class="w-full whitespace-no-wrap">
            <thead>
              <tr
                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
              >
                <th class="px-4 py-3">{{ __("#") }}</th>
                <th class="px-4 py-3">{{ __("Url") }}</th>
                <th class="px-4 py-3">{{ __("Desscrição") }}</th>
                
              </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
              @forelse ($urls as $url)
                <tr class="text-gray-700 dark:text-gray-400">
                  <td class="px-4 py-3">
                    <p class="font-semibold">{{ $url->id }}</p>
                  </td>
                  <td class="px-4 py-3">
                    <p class="font-semibold">{{ $url->url }}</p>
                  </td>
                  <td class="px-4 py-3 text-sm">
                    {{ $url->nome_site }}
                  </td>
                  
                </tr>  
              @empty
                  <tr class="text-pink-600 dark:text-pink-900">
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium">
                      <p class="font-semibold">{{ __(" Não foi adicionada nenhum url") }}</p>
                      <span class="font-semibold">{{ __("Não existe informação em nosa base de dados!") }}</span>
                    </td>
                  </tr>
              @endforelse
            </tbody>
          </table>
          <div class="pag-wide px-8 py-2 text-xs font-semibold tracking-wide text-gray-500 dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            @if ($urls->count())
                <div class="mt-3">
                  {{ $urls->links() }}
                </div>
            @endif   
          </div>
      </section>
  </div>
</main>
@endsection
@push('scripts')
<script>


  $(() => {
      $(".delete").click(function () {
          var title = $(this).data("product-title"),
              id = $(this).data("product-id");
          swal({
              title: '',
              text: `${delete_question} Title: ${title}`,
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Sim',
              cancelButtonText: 'Não'
          }, () => {
              $(`#delete_${id}`).submit();
          });
      });

      $(".see-description").click(function () {
          var id = $(this).data("product-id");
          var text = $(`#description_${id}`).html();
          swal({
              title: '',
              text: $(`#description_${id}`).html(),
              html: true,
              type: 'info',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33'
          });
      });

  });

  //Get noUISlider Value and write on
  function getNoUISliderValue(slider, percentage) {
      slider.noUiSlider.on('update', function () {
          var val = slider.noUiSlider.get();
          var min = parseInt(val[0]),
              max = parseInt(val[1]);
          $("#from_stock").html(min);
          $("#to_stock").html(max);
          $("#input_from_stock").val(min);
          $("#input_to_stock").val(max);
      });
  }
</script>
@endpush