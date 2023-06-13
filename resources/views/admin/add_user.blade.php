@extends('admin.app')
@section('title')
Add User
@endsection
@section('content')
<div class="body flex-grow-1 px-3">
<div class="container-lg">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header"><strong>Add User</strong></div>
          <div class="card-body">
            
            <div class="example">
                  @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <p class="alert alert-danger">{{ $error }}</p>
                        @endforeach
                  @endif
              <div class="tab-content rounded-bottom">
                <form method="POST" action="{{ route('admin.submit.user') }}">
                    @csrf
                <div class="tab-pane p-3 active preview" role="tabpanel" >
                  <div class="input-group mb-3">
                    <input class="form-control" type="text" placeholder="Name" name="name" value="{{ old('name') }}">
                  </div>
                  <div class="input-group mb-3">
                    <input class="form-control" type="text" placeholder="Email" name="email" value="{{ old('email') }}">
                  </div>
                  <div class="input-group mb-3">
                    <input class="form-control" type="password" placeholder="Password" name="password">
                  </div>
                  <div class="input-group mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                  
                  
                </div></form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div></div></div>

@endsection