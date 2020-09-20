<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Models\Retorno;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $urls = new Url();
        $urls = $urls->filtros($request);
        $request->flash();

        return view('urls.index')->with(compact('urls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('urls.add_edit')->with(['urls' => null]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|',
            'nome_site' => 'required',
        ]);

        $url = new Url([
            'url' => $request->get('url'),
            'nome_site' => $request->get('nome_site'),
            'user_id' => auth()->id()
        ]);
        $url->save();

        return redirect()->route('urls.index')->with('success', 'Url Adicionada');
    }


    public function searchContent(Request $request) {
        $url_id = $request->has('url_id') ? $request->url_id : false;

        if ($url_id) {
            $dados = Retorno::where('url_id',$url_id)->first();
            $content = base64_decode($dados->retorno);

            return response()->json(['result' => 'OK', 'retorno' => $content]);
        } else {
            return response()->json(['result' => 'ERRO']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function show(Url $url)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function edit(Url $url)
    {
        if (is_null($url)) {
            abort(404);
        }
        return view('urls.add_edit')->with(compact('urls'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Url $url)
    {
        $validator = $this->isValid($request, false);
        $request->flash();
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        if (is_null($url)) {
            abort(404);
        }
        $url->store($request);
        return redirect()->route('urls.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function destroy(Url $url)
    {
        $url->delete();
        return redirect()->route('urls.index');
    }

    public function isValid(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'endereco' => ['url'],
            'nome_site' => ['required'],
        ]);

        return $validator;
    }
}
