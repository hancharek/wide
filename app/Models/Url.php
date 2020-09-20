<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Url extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'nome_site',
        'user_id'
    ];

    public function filtros(Request $request)
    {
        $endereco = $request->has('url') ? $request->url : false;
        $nome_site = $request->has('nome_site') ? $request->nome_site : false;

        $urls = $this
            ->when($endereco, function ($query) use ($endereco) {
                return $query->where('url', 'LIKE', "%$endereco%");
            })
            ->when($nome_site, function ($query) use ($nome_site) {
                return $query->where('nome_site', 'LIKE', "%$nome_site%");
            })
            ->paginate();
        return $urls;
    }

    public function store(Request $request)
    {
        $this->url = $request->url;
        $this->nome_site = $request->nome_site;
        $this->user_id = Auth::user()->id;

        try {
            DB::beginTransaction();
            $this->save();
            DB::commit();
            return $this;
        } catch (Exception $e) {
            Log::error(__FILE__ . ' - Line:' . __LINE__ . ' - ERROR : ' . $e->getMessage());
            return false;
        }
    }

}
