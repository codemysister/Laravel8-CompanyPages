@extends('admin.admin_master')
@section('admin')
    <div class="py-12">
        <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                   <div class="card-header">
                        <a href="{{route('slider.create')}}" class="btn btn-primary">Add Slider</a>   
                    </div> 
                  @if(session('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('success')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endif

                  <div class="card-header">All Slider</div>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" width="5%">No</th>
                        <th scope="col" width="10%">Title</th>
                        <th scope="col" width="25%">Description</th>
                        <th scope="col" width="15%">Image</th>
                        <th scope="col" width="15%">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      @php($i=1)
                      @foreach($sliders as $slider)
                      <tr>
                        <th scope="row">{{$i++}}</th>
                        <td>{{$slider->title}}</td>
                        <td>{{$slider->description}}</td>
                        <td><img src="{{asset($slider->image)}}" alt="" style="height: 40px; width:70px"></td>
                
                        <td>
                            <a href="{{url('slider/edit/'.$slider->id)}}" class="btn btn-primary">Edit</a> 
                            <a href="{{url('slider/delete/'.$slider->id)}}" onclick="return confirm('Are you sure about it?')" class="btn btn-danger">Delete</a>  
                        </td>
                      </tr>
                      @endforeach
                
                    </tbody>
                  </table>
            
                </div>
                </div>
            </div>
        </div>



    </div>
    @endsection

