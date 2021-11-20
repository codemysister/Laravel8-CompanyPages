@extends('admin.admin_master')
@section('admin')
<div class="card card-default">
										
    <div class="card-header card-header-border-bottom">
        <h2>Change Password</h2>
        
    </div><div class="card-body">
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>{{session('error')}}</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <form method="POST" action="{{route('password.update')}}" class="form-pill">
            @csrf
    <div class="card-body">
            <div class="form-group">
                <label for="exampleFormControlInput3">Current Password</label>
                <input id="current_password" type="password" class="form-control" id="exampleFormControlInput3" name="oldpassword">
                @error('oldpassword')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleFormControlPassword3">Password</label>
                <input id="password" type="password" class="form-control" id="exampleFormControlPassword3" placeholder="Password" name="password">
                @error('password')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleFormControlPassword3">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" id="exampleFormControlPassword3" placeholder="Password">
                @error('password_confirmation')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
           <button class="btn btn-primary" type="submit">Save</button>
        </form>
    </div>
</div>
@endsection