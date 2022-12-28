@extends('layouts.app')

@section('title', 'Update Product')

@section('content')
    <div class="container pt-5">
        <div class="col-12 card">
            @include('partials.errors')
        </div>
        <div class="col-12 card">
            <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group pt-3">
                    <label class="col-sm-2 control-label" for="sku">SKU:</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ $product->sku }}" id="sku" name="sku" class="form-control">
                    </div>
                </div>
                <div class="pb-3">
                    <label class="col-sm-2 control-label" for="name">Name:</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ $product->name }}" name="name" class="form-control" id="name">
                    </div>
                </div>
                <div class="pb-3">
                    <label class="col-sm-2 control-label" for="main_image">Price:</label>
                    <div class="col-sm-10">
                        <input type="number" value="{{ $product->price }}" name="price"  class="form-control" id="price">
                    </div>
                </div>
                <div class="pb-3">
                    <label class="col-sm-2 control-label" for="description">Description:</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ $product->description }}" name="description"  class="form-control" id="description">
                    </div>
                </div>
                <div class="pb-3">
                        <label for="main_image" class="form-label col-sm-2">Product Image</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="file" id="main_image" name="main_image">
                        </div>
                </div><hr>
                <div class="col-md-4 text-center justify-content-center m-auto pb-2">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
