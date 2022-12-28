<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use DataTables;
use GuzzleHttp\Handler\Proxy;

class ProductsController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Product::all();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="'. route('products.show', $row->id) .'" class="btn btn-primary btn-sm">View</a> &nbsp;';
                    $btn .= '<a href="'. route('products.edit', $row->id) .'" class="btn btn-success btn-sm">Edit</a> &nbsp;';

                    $btn .= '<a href="'. route('products.destroy', $row->id) .'" class="btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('products.index');
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){
        Product::create([
            "sku" => $request->sku,
            "name" => $request->name,
            "price" => $request->price,
            "description" => $request->description,
            "main_image" => $request->main_image
        ]);

        // update the salla product
        return redirect()->route('products.index');
    }

    public function show($id){
        $product = Product::find($id);
        return view('products.show', compact('product'));
    }

    public function edit($id){
        $product = Product::find($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id){
        Product::find($id)->update([
            "sku" => $request->sku,
            "name" => $request->name,
            "price" => $request->price,
            "description" => $request->description,
            "main_image" => $request->main_image
        ]);

        // update the salla product

        return redirect()->route('products.index');
    }

    public function destroy($id){
        Product::find($id)->delete();
        return redirect()->route('products.index');
    }
}
