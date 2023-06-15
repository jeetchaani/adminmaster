@extends('admin.app')
@section('title')
Images
@endsection
@section('content')
<div style="align-items: center;">
    <a href="{{ route('admin.image.add') }}">
    <button class="btn btn-success">Add Image</button>
    </a>
</div>
<div class="tab-content rounded-bottom">
              @if (session('msg'))
               <p class="alert alert-success"> {{session('msg')}} </p>
              @endif
              @if(session('delete'))
              <p class="alert alert-success"> {{session('delete')}} </p>
              @endif
    <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-557">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">UserName</th>
            <th scope="col">Img</th>
            
          
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($images as $image)
            
          
          <tr>
            <th scope="row">{{ $image['id'] }}</th>
            <td>
              <a href="{{ route('admin.edit.user') }}/?id={{ $image['user_id'] }}">
              {{ $image['name'] }}
              </a>
            </td>
            <td>
              <img src="{{ asset('images') }}/{{ $image['file_name'] }}" height="35" width="35">
            </td>
           
            
            <td>
              <a href="{{ route('admin.image.delete') }}/?id={{ $image['id'] }}">
                <button class="btn btn-danger">Delete</button>
              </a>
            </td>
          </tr>
          @endforeach
         
        </tbody>
      </table>
    {{ $images->links() }}
    </div>
</div>
@endsection