<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Url;
use App\Models\Retorno;
use http\Urls;
use Carbon\Carbon;

class consultaUrl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consultaUrl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command de consulta das Urls, a cada 2 minutos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $retorno = Retorno::pluck('url_id')->all();
        $lista_urls = Url::all();

        foreach ($lista_urls as $index => $lista_url) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $lista_url->url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            $header_size = curl_getinfo($ch,CURLINFO_HEADER_SIZE);
            $header = substr($result, 0, $header_size);
            $body = substr( $result, $header_size );
            curl_close($ch);


            $retorno = quoted_printable_encode($body);

            $gravar_retorno = new Retorno();
            $gravar_retorno->url_id = $lista_url->id;
            $gravar_retorno->cod_retorno = $httpCode;
            $gravar_retorno->retorno = $retorno;
            $gravar_retorno->dt_consulta = date_format(Carbon::now(), 'Y-m-d H:i:s');
            $gravar_retorno->save();

        }

    }
}
