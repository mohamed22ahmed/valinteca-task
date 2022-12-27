<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use DataTables;

class ProductsController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Product::all();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('main_image', function($row){
                    return $row->main_image . 'dddddd';
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="'. route('products.show', $row->id) .'" class="btn btn-primary btn-sm">View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('products.index');
    }

    public function show($id){
        $product = Product::find($id);
        return view('products.show', compact('product'));
    }
}
