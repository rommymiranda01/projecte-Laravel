<?php

namespace App\Http\Controllers;

use App\Models\Joc;
use Illuminate\Http\Request;

class JocController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()){
            return Joc::all();
        }else{
            return view('jocs.indexJocs');
        }
    }

    public function store(Request $request){
        $joc = new Joc();
        $joc->create($request->all());
    }

    public function update(Request $request, Joc $joc){
        $joc->update($request->all());
    }

    public function destroy(Joc $joc){
        $joc->delete();
    }
}
