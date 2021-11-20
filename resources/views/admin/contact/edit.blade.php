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
                      Edit Contact
                    </div>
                    <div class="card-body">
                      <form action="{{url('update/contact/'.$contact->id)}}" method="POST" >
                        @csrf

                        
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Email</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="email" name="email" value="{{$contact->email}}">
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Phone</label>
                            <input type="number" name="phone" class="form-control" placeholder="phone" value="{{$contact->phone}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Address</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="address" value="{{$contact->address}}">{{$contact->address}}</textarea>
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