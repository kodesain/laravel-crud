@extends('layout')

@section('content')
<div class="card">
    <div class="card-header">
        Add Product
    </div>
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul class="m-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="prod_name">Product</label>
                <input type="text" class="form-control" id="prod_name" name="prod_name" value="{{ old('prod_name') }}" required>
            </div>
            <div class="form-group">
                <label for="cat_id">Category</label>
                <select class="form-control" id="cat_id" name="cat_id">
                    @foreach($categories as $category)
                    @if($category->cat_id == old('cat_id'))
                    <option value="{{ $category->cat_id }}" selected>{{ $category->cat_name }}</option>
                    @else
                    <option value="{{ $category->cat_id }}">{{ $category->cat_name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="prod_description">Description</label>
                <input type="text" class="form-control" id="prod_description" name="prod_description" value="{{ old('prod_description') }}" required>
            </div>
            <div class="form-group">
                <label for="prod_price">Price</label>
                <input type="number" class="form-control text-right" id="prod_price" name="prod_price" value="{{ old('prod_price') }}" required>
            </div>
            <div class="form-group">
                <label for="prod_image">Image File</label>
                <input type="file" class="form-control" id="prod_image" name="prod_image">
            </div>
            <div class="form-group text-right">
                <button type="button" class="btn btn-danger" onclick="window.location.href = '{{ route('products.index') }}';"><i class="fas fa-times"></i> Close</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Create Product</button>
            </div>
        </form>
    </div>
</div>
@endsection