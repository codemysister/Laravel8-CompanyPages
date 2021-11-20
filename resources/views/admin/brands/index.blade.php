@extends('admin.admin_master')
@section('admin')
    <div class="py-12">
        <div class="container">
            <div class="row">
              <div class="col-md-8">
                <div class="card">

                  

                  <div class="card-header">All Brands</div>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Brand Name</th>
                        <th scope="col">Brand Image</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                   
                    
                      @foreach($brands as $brand)
                      <tr>
                        <th scope="row">{{$brands->firstItem()+$loop->index}}</th>
                        <td>{{$brand->brand_name}}</td>
                        <td><img src="{{asset($brand->brand_image)}}" alt="" style="height: 40px; width:70px"></td>
                        <td>
                          @if($brand->created_at == NULL)
                          <span class="text-danger">Data Not Set</span>
                          @else
                          {{Carbon\Carbon::parse($brand->created_at)->diffForHumans()}}
                          @endif
                        </td>
                        <td>
                            <a href="{{url('brand/edit/'.$brand->id)}}" class="btn btn-primary">Edit</a> 
                            <a href="{{url('brand/delete/'.$brand->id)}}" onclick="return confirm('Are you sure about it?')" class="btn btn-danger">Delete</a>  
                        </td>
                      </tr>
                      @endforeach
                
                    </tbody>
                  </table>
                  {{ $brands->links() }}
                </div>
                </div>

                <div class="col-md-4">
                  <div class="card">
                    <div class="card-header">
                      Add Brands
                    </div>
                    <div class="card-body">
                      <form action="{{route('addBrand')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          <label for="brand_name" class="form-label">Brand Name</label>
                          <input type="text" class="form-control" id="brand_name" name="brand_name">
                          @error('brand_name')
                              <span class="text-danger">{{$message}}</span>
                          @enderror  
                        </div>
                        <div class="mb-3">
                            <label for="brand_image" class="form-label">Brand Image</label>
                            <input type="file" class="form-control" id="brand_image" name="brand_image">
                            @error('brand_image')
                                <span class="text-danger">{{$message}}</span>
                            @enderror  
                          </div>
                        <button type="submit" class="btn btn-primary">Add Brand</button>
                      </form>
                    </div>
                  </div>
                </div>

            </div>
        </div>



    </div>
    @endsection

