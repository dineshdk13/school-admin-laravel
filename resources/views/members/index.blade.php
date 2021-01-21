@extends('members.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Check all members</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('members.create') }}"> Create new Member</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered" enctype="multipart/form-data">
        <tr>
            <th>No</th>
            <th>filename</th>
            <th>Username</th>
            <th>Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Role</th>
            <th width="250px">Action</th>
        </tr>
        @foreach ($members as $member)
        <tr>
            <td>{{ ++$i }}</td>
            <td><img src="{{ Storage::url($member->filename) }}" height="40" alt="" /></td>
            <!-- <td><img src="{{ $member->filename }}" height="40"></td> -->
            <td>{{ $member->username }}</td>
            <td>{{ $member->fname ." ". $member->lname }}</td>
            <td>{{ $member->email }}</td>
            <td>{{ $member->gender }}</td>
            <td>{{ $member->role }}</td>
            <td>
                <form action="{{ route('members.destroy',$member->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('members.show',$member->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('members.edit',$member->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $members->links() !!}
      
@endsection