@extends('admin.admin_master')
@section('admin')


    <div class="py-12">
        <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                    @if(session('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('success')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endif
                 
                    <div class="card-header">
                      Edit Profile
                    </div>
                    <div class="card-body">
                      <form action="{{route('update.profile')}}" method="POST" >
                        @csrf

                        
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Name</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="name" name="name" value="{{$user->name}}">
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="email" value="{{$user['email']}}">
                        </div>
                    

                        <button type="submit" class="btn btn-primary">Edit Profile</button>
                      </form>
                    </div>
                  </div>
                </div>

            </div>
        </div>
    </div>


@endsection