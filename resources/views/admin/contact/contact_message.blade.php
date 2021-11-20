@extends('admin.admin_master')
@section('admin')
    <div class="py-12">
        <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="card">

                  <div class="card-header">All Message</div>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Message</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                   
                       @php($i=1)
                      @foreach($message as $m)
                      <tr>
                        <th scope="row">{{$i++}}</th>
                        <td>{{$m->name}}</td>
                        <td>{{$m->email}}</td>
                        <td>{{$m->subject}}</td>
                        <td>{{$m->message}}</td>
                        <td>
                            <a href="" onclick="return confirm('Are you sure about it?')" class="btn btn-danger">Delete</a>  
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

