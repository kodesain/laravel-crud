@extends('layout')

@section('content')
<div class="card">
    <div class="card-header">
        Add Category
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
        <form method="post" action="{{ route('categories.store') }}">
            @csrf
            <div class="form-group">
                <label for="cat_name">Category</label>
                <input type="text" class="form-control" id="cat_name" name="cat_name" value="{{ old('cat_name') }}" required>
            </div>
            <div class="form-group">
                <label for="cat_description">Description</label>
                <input type="text" class="form-control" id="cat_description" name="cat_description" value="{{ old('cat_description') }}" required>
            </div>
            <div class="form-group text-right">
                <button type="button" class="btn btn-danger" onclick="window.location.href = '{{ route('categories.index') }}';"><i class="fas fa-times"></i> Close</button>
                <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Create Category</button>
            </div>
        </form>
    </div>
</div>
@endsection