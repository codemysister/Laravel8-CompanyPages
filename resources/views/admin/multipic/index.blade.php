
@extends('admin.admin_master');
@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
              <div class="col-md-8">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>{{session('success')}}</strong>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                
                <div class="card-group">
                   
                    @foreach($images as $img)
                        <div class="col-md-3 mt-4 p-2">
                            <div class="card">
                                <img src="{{asset($img->image)}}" alt="">
                            </div>
                        </div>
                    @endforeach
                </div>
              </div>
                <div class="col-md-4">
                  <div class="card">
                    <div class="card-header">
                      Add Multi Image
                    </div>
                    <div class="card-body">
                      <form action="{{route('addMultiPic')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          <label for="multipic" class="form-label">Input Image</label>
                          <input type="file" class="form-control" id="multipic" name="multipic[]" multiple>
                          @error('multipic')
                              <span class="text-danger">{{$message}}</span>
                          @enderror  
                        </div>
                        <button type="submit" class="btn btn-primary">Add Multi Image</button>
                      </form>
                    </div>
                  </div>
                </div>

            </div>
        </div>

    </div>
        
@endsection