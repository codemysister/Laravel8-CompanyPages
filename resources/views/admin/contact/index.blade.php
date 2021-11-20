@extends('admin.admin_master')
@section('admin')
    <div class="py-12">
        <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                   <a href="{{route('admin.addcontact')}}" class="btn btn-primary">Add Contact</a>
                  @if(session('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('success')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endif

                  <div class="card-header">All Contact</div>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                   
                       @php($i=1)
                      @foreach($contact as $con)
                      <tr>
                        <th scope="row">{{$i++}}</th>
                        <td>{{$con->email}}</td>
                        <td>{{$con->phone}}</td>
                        <td>{{$con->address}}</td>
                        <td>
                            <a href="{{url('edit/contact/'.$con->id)}}" class="btn btn-primary">Edit</a> 
                            <a href="{{url('delete/contact/'.$con->id)}}" onclick="return confirm('Are you sure about it?')" class="btn btn-danger">Delete</a>  
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

