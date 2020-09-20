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
        <!--Modal-->
  <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
    
    <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
      
      <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
        <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
          <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
        </svg>
        <span class="text-sm">(Esc)</span>
      </div>

      <!-- Add margin if you want to see some of the overlay behind the modal-->
      <div class="modal-content py-4 text-left px-6">
        <!--Title-->
        <div class="flex justify-between items-center pb-3">
          <p class="text-2xl font-bold">Simple Modal!</p>
          <div class="modal-close cursor-pointer z-50">
            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
              <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
            </svg>
          </div>
        </div>

        <!--Body-->
        <p>Modal content can go here</p>
        <p>...</p>
        <p>...</p>
        <p>...</p>
        <p>...</p>

        <!--Footer-->
        <div class="flex justify-end pt-2">
          <button class="px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">Action</button>
          <button class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Close</button>
        </div>
        
      </div>
    </div>
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
        <th class="px-4 py-3">{{ __("Status") }}</th>
        <th class="px-4 py-3">{{ __("Data Consulta") }}</th>
        <th></th>
        
      </tr>
    </thead>
    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
      @forelse ($retornos as $linha)
        <tr class="text-gray-700 dark:text-gray-400">
          <td class="px-4 py-3">
            <p class="font-semibold">{{ $linha->url_id }}</p>
          </td>
          <td class="px-4 py-3">
            <p class="font-semibold">{{ \App\Models\Urls::find($linha->url_id)->url }}</p>
          </td>
          <td class="px-4 py-3 text-sm">
            {{ \App\Models\Urls::find($linha->url_id)->nome_site }}
          </td>
          <td class="px-4 py-3">
            <p class="font-semibold">{{ $linha->cod_retorno }}</p>
          </td>
          <td class="px-4 py-3">
            <p class="font-semibold">{{ $linha->dt_consulta }}</p>
          </td>
          <td><a href="" class="modal-open bg-transparent border border-gray-500 hover:border-indigo-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full" onclick="conteudo({{$linha->url_id}})" data-toggle="modal" >Visualizar</a>
          
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
    @if ($retornos->count())
        <div class="mt-3">
          {{ $retornos->links() }}
        </div>
    @endif   
  </div>

      </section>
  </div>
</main>
@endsection
@push('scripts')
<script>
    function content(id) {
            $.ajax({
                method: "post",
                data: { url_id: id,
                    _token: "{{ csrf_token() }}" },
                url: "{{ route('url.pesquisa') }}",
            }).done(function(response) {
                if (response.result = "OK") {
                    $("#conteudo_site").html(response.retorno);
                } else {
                    $("#conteudo_site").html("Sem retorno para este site");
                }

            });
        }

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

        function visualiza(url) {

        }

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

    var openmodal = document.querySelectorAll('.modal-open')
    for (var i = 0; i < openmodal.length; i++) {
      openmodal[i].addEventListener('click', function(event){
    	event.preventDefault()
    	toggleModal()
      })
    }
    
    const overlay = document.querySelector('.modal-overlay')
    overlay.addEventListener('click', toggleModal)
    
    var closemodal = document.querySelectorAll('.modal-close')
    for (var i = 0; i < closemodal.length; i++) {
      closemodal[i].addEventListener('click', toggleModal)
    }
    
    document.onkeydown = function(evt) {
      evt = evt || window.event
      var isEscape = false
      if ("key" in evt) {
    	isEscape = (evt.key === "Escape" || evt.key === "Esc")
      } else {
    	isEscape = (evt.keyCode === 27)
      }
      if (isEscape && document.body.classList.contains('modal-active')) {
    	toggleModal()
      }
    };
    
    
    function toggleModal () {
      const body = document.querySelector('body')
      const modal = document.querySelector('.modal')
      modal.classList.toggle('opacity-0')
      modal.classList.toggle('pointer-events-none')
      body.classList.toggle('modal-active')
    }
    
     
  </script>
@endpush