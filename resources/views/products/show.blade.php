@extends('layouts.app')

@section('title', 'Show Product')

@section('content')
    <div class="container pt-5">
        <div class="col-12 card">
            <div class="pt-3">
                <span style="font-weight:bold">#</span>
                <span>{{ $product->id }}</span>
            </div><hr>
            <div class="pb-3">
                <span style="font-weight:bold">SKU : </span>
                <span>{{ $product->sku }}</span>
            </div>
            <div class="pb-3">
                <span style="font-weight:bold">Name : </span>
                <span>{{ $product->name }}</span>
            </div>
            <div class="pb-3">
                <span style="font-weight:bold">Price : </span>
                <span>{{ $product->price }}</span>
            </div>
            <div class="pb-3">
                <span style="font-weight:bold">Description : </span>
                <span>{{ $product->description }}</span>
            </div>
            <div class="pb-3">
                <span style="font-weight:bold">Main Image : </span>
                <span>{{ $product->main_image }}</span>
            </div><hr>
            <div class="col-md-8 text-center justify-content-center m-auto pb-2">
                <a href="{{ route('products.index') }}" class="btn btn-primary">Return To Products</a>&nbsp;
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-success">Edit Product</a>
            </div>
        </div>
    </div>
@endsection
