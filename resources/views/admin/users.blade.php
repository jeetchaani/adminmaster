@extends('admin.app')
@section('title')
Users
@endsection
@section('content')
<div style="align-items: center;">
  <span style="padding-right: 20px;">
    <a href="{{ route('admin.add.user') }}">
    <button class="btn btn-success">Add</button>
    </a>
  </span>
  <span>
    <a href="{{ route('admin.google') }}">
      <button class="btn btn-success">Login With Google</button>
      </a>
  </span>
</div>
<div class="tab-content rounded-bottom">
              @if (session('msg'))
               <p class="alert alert-success"> {{session('msg')}} </p>
              @endif
              @if(session('delete'))
              <p class="alert alert-danger"> {{session('delete')}} </p>
              @endif
    <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-557">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
            
          
          <tr>
            <th scope="row">{{ $user['id'] }}</th>
            <td>{{ $user['name'] }}</td>
            <td>{{ $user['email'] }}</td>
           
            <td>
              <a href="{{ route('admin.edit.user') }}/?id={{ $user['id'] }}">
                <button class="btn btn-primary">Edit</button>
              </a>
            </td>
            <td>
              <a href="{{ route('admin.user.delete') }}/?id={{ $user['id'] }}">
                <button class="btn btn-danger">Delete</button>
              </a>
            </td>
          </tr>
          @endforeach
         
        </tbody>
      </table>
      {{$users->links()}}
    </div>
</div>
@endsection