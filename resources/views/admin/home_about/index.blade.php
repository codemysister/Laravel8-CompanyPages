@extends('admin.admin_master')
@section('admin')
    <div class="py-12">
        <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                   <a href="{{route('add.about')}}" class="btn btn-primary">Add About</a>
                  @if(session('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('success')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endif

                  <div class="card-header">All About</div>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">About Title</th>
                        <th scope="col">Short Description</th>
                        <th scope="col">Long Description</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                   
                       @php($i=1)
                      @foreach($homeabout as $about)
                      <tr>
                        <th scope="row">{{$i++}}</th>
                        <td>{{$about->title}}</td>
                        <td>{{$about->short_desc}}</td>
                        <td>{{$about->long_desc}}</td>
                        <td>
                            <a href="{{url('edit/about/'.$about->id)}}" class="btn btn-primary">Edit</a> 
                            <a href="{{url('delete/homeabout/'.$about->id)}}" onclick="return confirm('Are you sure about it?')" class="btn btn-danger">Delete</a>  
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

