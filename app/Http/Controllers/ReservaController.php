<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()){
            return Reserva::all();
        }else{
            return view('reserva.indexReserves');
        }
    }

    public function show(Reserva $reserva)
    {
        return $reserva;
    }

    public function store(Request $request){
        $reserva = new Reserva();
        $reserva->create($request->all());
    }

    public function update(Request $request, Reserva $reserva){
        $reserva->update($request->all());
    }

    public function destroy(Reserva $reserva){
        $reserva->delete();
    }
}
