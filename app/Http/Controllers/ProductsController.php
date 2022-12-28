<?php

namespace App\Http\Controllers;

use App\Events\GetProductsEvent;
use App\Http\Requests\CreateUpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use DataTables;
use File;
use Illuminate\Support\Facades\Event;

class ProductsController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $data = Product::all();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="'. route('products.show', $row->id) .'" class="btn btn-primary btn-sm">View</a> &nbsp;';
                    $btn .= '<a href="'. route('products.edit', $row->id) .'" class="btn btn-success btn-sm">Edit</a> &nbsp;';
                    $btn .= '<a href="'. route('products.destroy', $row->id) .'" onclick="return confirm(`Are you Sure`)" class="btn btn-danger btn-sm">Delete</a>';
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

    public function create(){
        return view('products.create');
    }

    public function store(CreateUpdateProductRequest $request){
        $main_image = $this->getImageName($request);

        Product::create([
            'id' => $this->getNextId,
            'sku' => $request->sku,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'main_image' => $main_image
        ]);

        // id
        // 2084129150  1362941803

        // update the salla product
        return redirect()->route('products.index');
    }

    public function edit($id){
        $product = Product::find($id);
        return view('products.edit', compact('product'));
    }

    public function update(CreateUpdateProductRequest $request, $id){
        if($request->hasFile('main_image')){
            $this->deleteImage($id);
            $main_image = $this->getImageName($request);
        }else{
            $product = Product::find($id);
            $main_image = $product->main_image;
        }

        Product::find($id)->update([
            'sku' => $request->sku,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'main_image' => $main_image
        ]);

        // update the salla product

        return redirect()->route('products.index');
    }

    public function destroy($id){
        $this->deleteImage($id);
        Product::find($id)->delete();
        return redirect()->route('products.index');
    }

    public function pullNow(){
        event(new GetProductsEvent);
        return \redirect()->route('products.index');
    }

    protected function getImageName($request){
        if($request->hasFile('main_image')){
            $fileExt=$request->file('main_image')->getClientOriginalExtension();
            $fileNewName=$request->id.'_'.time().'.'.$fileExt;
            $path=$request->file('main_image')->storeAs('public/products',$fileNewName);

            return $fileNewName;
        }

        return 'default.jpg';
    }

    protected function deleteImage($id){
        $product = Product::find($id);
        $imageUrl = 'storage/products/'.$product->main_image;
        if(File::exists(public_path($imageUrl))){
            File::delete(public_path($imageUrl));
        }
    }

    protected function getNextId(){
        $product = Product::latest()->first();
        return $product->id + 1;
    }
}
