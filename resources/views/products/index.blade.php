@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <div class="row pt-5">
        <div class="col-12">
            <div class="float-right">
                <a href="{{ route('products.index') }}" class="btn btn-primary">Pull Now</a>&nbsp;
                <a href="{{ route('products.create') }}" class="btn btn-success">Create Product</a>
            </div>
        </div>
    </div><br><br>
    <div class="row">
        
        <div class="col-12 table-responsive">
            <table class="table table-bordered products_datatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>SKU</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Main Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
  $(function () {
    var table = $('.products_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('products.index') }}",
        columns: [
            {data: 'id', name: 'id'}, 
            {data: 'sku', name: 'sku'},
            {data: 'name', name: 'name'},
            {data: 'price', name: 'price'},
            {data: 'description', name: 'description'},
            { data: 'main_image', name: 'main_image', orderable: false, searchable: false,
                render: function( data, type, full, meta ) {
                    return "<img src=\"/storage/products/" + data + "\" height=\"50\" width=\"50\"  class=\"rounded-circle\" />";
                }
            },
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });
</script>
@endsection