<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    public function index(Request $request)
    {
        $data = DB::table('product')
            ->select('*')
            ->get();

        return view('product', ['product_list'=>$data]);
    }

    public function createProduct(Request $request)
    {
        $product = DB::table('product')
            ->insert(
                [
                    'name' => $request->name,
                    'cost' => $request->cost,
                    'price' => $request->price,
                ]
            );
        return redirect('/product');
    }

    public function confirmDelete(Request $request){
        $product_id = $request->id;
        $product = DB::table('product')
            ->where('id', $product_id)
            ->select('*')
            ->first();
        return view('confirm_delete', ['product'=>$product]);
    }

    public function doDelete(Request $request){
        $product_id = $request->id;
        $product = DB::table('product')
            ->where('id', $product_id)
            ->delete();
        return redirect('/product');
    }

    public function getEdit(Request $request){
        $product_id = $request->id;
        $product = DB::table('product')
            ->where('id', $product_id)
            ->select('*')
            ->first();
        return view('edit_product', ['product'=>$product]);
    }

    public function doEdit(Request $request)
    {
        $product_id = $request->id;
        $product = DB::table('product')
        ->where('id', $product_id)
        ->update(
            [
                'name' => $request->name,
                'cost' => $request->cost,
                'price' => $request->price,
            ]
        );
        return redirect('/product');
    }
}
