<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()){
            return Voucher::all();
        }else{
            return view('vouchers.IndexVouchers');
        }
    }

    public function show(Voucher $voucher)
    {
        return $voucher;
    }

    public function store(Request $request){
        $voucher = new Voucher();
        $voucher->create($request->all());
    }

    public function update(Request $request, Voucher $voucher){
        $voucher->update($request->all());
    }

    public function destroy(Voucher $voucher){
        $voucher->delete();
    }
}
