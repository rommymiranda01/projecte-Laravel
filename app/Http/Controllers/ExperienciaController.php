<?php

namespace App\Http\Controllers;

use App\Models\Experiencia;
use Illuminate\Http\Request;

class ExperienciaController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()){
            return Experiencia::all();
        }else{
            return view('experiencia.indexExperiencia');
        }
    }

    public function show(Experiencia $experiencia)
    {
        return $experiencia;
    }

    public function store(Request $request){
        $experiencia = new Experiencia();
        $experiencia->create($request->all());
    }

    public function update(Request $request, Experiencia $experiencia){
        $experiencia->update($request->all());
    }

    public function destroy(Experiencia $experiencia){
        $experiencia->delete();
    }
}
