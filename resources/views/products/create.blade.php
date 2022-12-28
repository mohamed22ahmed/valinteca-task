@extends('layouts.app')

@section('title', 'Create Product')

@section('content')
    <div class="container pt-5">
        <div class="col-12 card">
            <form action="{{ route('products.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="sku">SKU:</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ old('sku') }}" id="sku" name="sku" class="form-control">
                    </div>
                </div>
                <div class="pb-3">
                    <label class="col-sm-2 control-label" for="name">Name:</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ old('name') }}" name="name" class="form-control" id="name">
                    </div>
                </div>
                <div class="pb-3">
                    <label class="col-sm-2 control-label" for="main_image">Price:</label>
                    <div class="col-sm-10">
                        <input type="number" value="{{ old('price') }}" name="price"  class="form-control" id="price">
                    </div>
                </div>
                <div class="pb-3">
                    <label class="col-sm-2 control-label" for="description">Description:</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ old('description') }}" name="description"  class="form-control" id="description">
                    </div>
                </div>
                <div class="pb-3">
                    <label class="col-sm-2 control-label" for="main_image">Main Image:</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ old('main_image') }}" name="main_image"  class="form-control" id="main_image">
                    </div>
                </div><hr>
                <div class="col-md-4 text-center justify-content-center m-auto pb-2">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
