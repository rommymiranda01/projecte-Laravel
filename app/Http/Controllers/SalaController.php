<?php

namespace App\Http\Controllers;
use App\Models\Sala;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SalaController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()){
            return Sala::all();
        }else{
            return view('salas.indexSalas');
        }
    }

    public function show(Sala $sala)
    {
        return $sala;
    }

    public function store(Request $request){
        $sala = new Sala();
        $sala->create($request->all());
    }

    public function update(Request $request, Sala $sala){
        $sala->update($request->all());
    }

    public function destroy(Sala $sala){
        $sala->delete();
    }
}
