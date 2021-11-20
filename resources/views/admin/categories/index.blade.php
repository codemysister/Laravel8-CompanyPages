<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Categories
        </h2>
        
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
              <div class="col-md-8">
                <div class="card">

                  @if(session('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('success')}}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endif

                  <div class="card-header">All Categories</div>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">User_id</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                   
                    
                      @foreach($categories as $category)
                      <tr>
                        <th scope="row">{{$categories->firstItem()+$loop->index}}</th>
                        <td>{{$category->category_name}}</td>
                        <td>{{$category->userRelation->name}}</td>
                        <td>
                          @if($category->created_at == NULL)
                          <span class="text-danger">Data Not Set</span>
                          @else
                          {{Carbon\Carbon::parse($category->created_at)->diffForHumans()}}
                          @endif
                        </td>
                        <td>
                            <a href="{{url('categories/edit/'.$category->id)}}" class="btn btn-primary">Edit</a> 
                            <a href="{{url('softdelete/category/'.$category->id)}}" class="btn btn-danger">Delete</a>  
                        </td>
                      </tr>
                      @endforeach
                
                    </tbody>
                  </table>
                  {{ $categories->links() }}
                </div>
                </div>

                <div class="col-md-4">
                  <div class="card">
                    <div class="card-header">
                      Add Categories
                    </div>
                    <div class="card-body">
                      <form action="{{route('addCategory')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                          <label for="categories_name" class="form-label">Categories Name</label>
                          <input type="text" class="form-control" id="categories_name" name="category_name">
                          @error('category_name')
                              <span class="text-danger">{{$message}}</span>
                          @enderror  
                        </div>
                        <button type="submit" class="btn btn-primary">Add Categories</button>
                      </form>
                    </div>
                  </div>
                </div>

            </div>
        </div>



        <div class="container">
          <div class="row">
            <div class="col-md-8">
              <div class="card">


                <div class="card-header">Trash Area</div>
              <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Name</th>
                      <th scope="col">User_id</th>
                      <th scope="col">Created At</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                 
                  
                    @foreach($trash as $category)
                    <tr>
                      <th scope="row">{{$categories->firstItem()+$loop->index}}</th>
                      <td>{{$category->category_name}}</td>
                      <td>{{$category->userRelation->name}}</td>
                      <td>
                        @if($category->created_at == NULL)
                        <span class="text-danger">Data Not Set</span>
                        @else
                        {{Carbon\Carbon::parse($category->created_at)->diffForHumans()}}
                        @endif
                      </td>
                      <td>
                          <a href="{{url('categories/restore/'.$category->id)}}" class="btn btn-success">Restore</a> 
                          <a href="{{url('permanentDelete/categories/'.$category->id)}}" class="btn btn-danger">Delete</a>  
                      </td>
                    </tr>
                    @endforeach
              
                  </tbody>
                </table>
                {{ $trash->links() }}
              </div>
              </div>

              <div class="col-md-4">
                
              </div>

          </div>
      </div>



    </div>
</x-app-layout>
