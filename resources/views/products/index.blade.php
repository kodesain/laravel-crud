@extends('layout')

@section('content')
<div class="card">
    <div class="card-header">
        Products
    </div>
    <div class="card-body">
        @if(session()->get('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
        @endif
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Category</th>
                    <th scope="col" class="text-center">Price</th>
                    <th scope="col">Image File</th>
                    <th scope="col" width="200">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->prod_name }}</td>
                    <td>{{ $product->cat_name }}</td>
                    <td class="text-right">{{ $product->prod_price }}</td>
                    <td>@if($product->prod_image != '')<img src="{{ url('public'.Storage::url($product->prod_image)) }}" width="100">@endif</td>
                    <td>
                        <a href="{{ route('products.edit', $product->prod_id) }}" class="btn btn-primary btn-sm float-left mr-1" role="button"><i class="fas fa-pen"></i> Edit</a>
                        <form method="post" action="{{ route('products.destroy', $product->prod_id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete?');"><i class="fas fa-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="button" class="btn btn-success" onclick="window.location.href = '{{ route('products.create') }}';"><i class="fas fa-plus"></i> Add Product</button>
    </div>
</div>
@endsection