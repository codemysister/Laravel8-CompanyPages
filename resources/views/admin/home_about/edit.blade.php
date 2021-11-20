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
                      Edit About
                    </div>
                    <div class="card-body">
                      <form action="{{url('update/about/'.$abouts->id)}}" method="POST" >
                        @csrf

                        
                        <div class="mb-3">
                          <label for="title" class="form-label">Title</label>
                          <input type="text" class="form-control" id="title" name="title" value="{{$abouts->title}}">
                          @error('title')
                              <span class="text-danger">{{$message}}</span>
                          @enderror  
                        </div>

                        <div class="mb-3">
                                <label for="exampleFormControlTextarea1">Short Description</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="short_desc" >{{$abouts->short_desc}}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Long Description</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="long_desc" >{{$abouts->long_desc}}</textarea> 
                          </div>




                        <button type="submit" class="btn btn-primary">Edit Brand</button>
                      </form>
                    </div>
                  </div>
                </div>

            </div>
        </div>
    </div>


@endsection