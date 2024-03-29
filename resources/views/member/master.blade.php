@extends('master')

@section('title')
    Manage Members
@endsection

@section('content')
<div class="col-md-13  text-center">
    <a href="/manage/members/add" class="btn btn-primary mt-2 mb-2">Add User</a>
</div>


<table class="table table-striped">
        <tr>
            <td>#</td>
            <td>Full name</td>
            <td>Email</td>
            <td>Role</td>
            <td>Gender</td>
            <td>Address</td>
            <td>Profile Picture</td>
            <td>DOB</td>
            <td>Action</td>

        </tr>
        @foreach ($members as $member)
        <tr>
            <td>{{$member->id}}</td>
            <td><a href="/member/{{$member->id}}">{{$member->name}}</a></td>
            <td>{{$member->email}}</td>
            <td>{{$member->role}}</td>
            <td>{{$member->gender}}</td>
            <td>{{$member->address}}</td>
            <td>
                <img width="100px" height="100px" src={{"/storage/images/memberImg/".$member->profile_picture}} alt="">
            </td>
            <td>{{$member->birthday}}</td>
            <td><a href="/manage/members/{{ $member->id }}/edit" class="btn btn-success">Edit</a>
                <form action="/manage/members/{{ $member->id }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger mr-2 mt-2">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <div class = "col-12" style="display:flex; flex-direction:row; justify-content: center; margin-top:25px;">{{ $members->links() }}</div>

    {{-- <script>
            $(document).ready(function(){
                $('.edit-btn').click(function(){
                    var row = $(this).closest('tr');
                    var id = row.find('td:eq(0)').text();
                    window.location.replace('members/' + id + '/edit');
                });

                $('.delete-btn').click(function(){
                    var row = $(this).closest('tr');
                    var id = row.find('td:eq(0)').text();
                    window.location.replace('members/' + id + '/delete');
                });

            });
        </script> --}}
@endsection
