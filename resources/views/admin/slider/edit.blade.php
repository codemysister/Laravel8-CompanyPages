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
                      Edit Slider
                    </div>
                    <div class="card-body">
                      <form action="{{url('slider/update/'.$sliders->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="old_image" value="{{$sliders->image}}">
                        <div class="mb-3">
                          <label for="title" class="form-label">Title</label>
                          <input type="text" class="form-control" id="title" name="title" value="{{$sliders->title}}">
                          @error('title')
                              <span class="text-danger">{{$message}}</span>
                          @enderror  
                        </div>

                        <div class="mb-3">
                                <label for="exampleFormControlTextarea1">Description</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" >{{$sliders->description}}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Slider Image</label>
                            <input type="file" class="form-control" id="image" name="image" value="{{$sliders->image}}">
                            @error('image')
                                <span class="text-danger">{{$message}}</span>
                            @enderror  
                          </div>

                          <div class="mb-3">
                            <img src="{{asset($sliders->image)}}" alt="" style="width:150px; height:100px">
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