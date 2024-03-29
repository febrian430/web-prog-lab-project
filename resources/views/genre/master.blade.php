@extends('master')

@section('title')
    Manage Genre
@endsection

@section('content')
    <div class="col-md-13 text-center">
        <a href="/manage/genres/add" class="btn btn-primary mb-2 mt-2">Add Genre</a>
    </div>
    <table class = "table table-striped container">
        <thead>
        <tr>
            <th scope="col" class="align-middle">#</th>
            <th scope="col" class="align-middle">Genre</th>
            <th scope="col" class="align-middle">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($genres as $genre)
        <tr>
            <td class="align-middle">{{$genre->id}}</td>
            <td class="align-middle">{{$genre->name}}</td>
            <td class="align-middle">
                <a href="/manage/genres/{{ $genre->id }}/edit" class="btn btn-success" style="float:left">Edit</a>
                <form action="/manage/genres/{{ $genre->id }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger ml-2">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>

@endsection
