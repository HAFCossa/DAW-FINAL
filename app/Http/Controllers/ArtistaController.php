<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArtistaController extends Controller
{
    public function index()
    {
        $data = Artista::latest()->paginate(5);
    
        return view('artistas.index',compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('artistas.create');
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
            'nome' => 'required',
            'biografia' => 'required',
            'foto' => 'required',
        ]);
    
        Artista::create($request->all());
     
        return redirect()->route('artistas.index')
                        ->with('success','Artista cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Artista $artista)
    {
        return view('artistas.show',compact('artista'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Artista $artista)
    {
        return view('artistas.edit',compact('artista'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artista $artista)
    {
        $request->validate([
            'nome' => 'required',
            'biografia' => 'required',
            'foto' => 'required',
        ]);
    
        $artista->update($request->all());
    
        return redirect()->route('artistas.index')
                        ->with('success','artistas actualizados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artista $artista)
    {
        $artista->delete();
    
        return redirect()->route('artistas.index')
                        ->with('success','Apagado');
}
}
