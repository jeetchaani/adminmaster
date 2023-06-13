@extends('admin.app')
@section('title')
Users
@endsection
@section('content')
<div style="align-items: center;">
    <a href="{{ route('admin.add.user') }}">
    <button class="btn btn-success">Add</button>
    </a>
</div>
<div class="tab-content rounded-bottom">
              @if (session('msg'))
               <p class="alert alert-success"> {{session('msg')}} </p>
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
                <button class="btn btn-primary">Edit</button>
            </td>
            <td>
                <button class="btn btn-danger">Delete</button>
            </td>
          </tr>
          @endforeach
         
        </tbody>
      </table>
    </div>
</div>
@endsection