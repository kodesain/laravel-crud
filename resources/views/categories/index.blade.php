@extends('layout')

@section('content')
<div class="card">
    <div class="card-header">
        Categories
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
                    <th scope="col">Category</th>
                    <th scope="col">Description</th>
                    <th scope="col" width="200">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->cat_name }}</td>
                    <td>{{ $category->cat_description }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category->cat_id) }}" class="btn btn-primary btn-sm float-left mr-1" role="button"><i class="fas fa-pen"></i> Edit</a>
                        <form method="post" action="{{ route('categories.destroy', $category->cat_id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete?');"><i class="fas fa-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="button" class="btn btn-success" onclick="window.location.href = '{{ route('categories.create') }}';"><i class="fas fa-plus"></i> Add Category</button>
    </div>
</div>
@endsection