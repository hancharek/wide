<?php

namespace App\Http\Controllers;

use App\Models\Retorno;
use App\Models\Url;
use Illuminate\Http\Request;

class RetornoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $retornos = Retorno::all();
        return view('retorno.index')->with(compact('retornos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Retorno  $retorno
     * @return \Illuminate\Http\Response
     */
    public function show(Retorno $retorno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Retorno  $retorno
     * @return \Illuminate\Http\Response
     */
    public function edit(Retorno $retorno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Retorno  $retorno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Retorno $retorno)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Retorno  $retorno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Retorno $retorno)
    {
        //
    }
}
