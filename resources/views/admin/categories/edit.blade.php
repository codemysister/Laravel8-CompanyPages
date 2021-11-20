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

                 
                    <div class="card-header">
                      Edit Categories
                    </div>
                    <div class="card-body">
                      <form action="{{url('categories/update/'.$categories->id)}}" method="POST">
                        @csrf
                        <div class="mb-3">
                          <label for="categories_name" class="form-label">Categories Name</label>
                          <input type="text" class="form-control" id="categories_name" name="category_name" value="{{$categories->category_name}}">
                          @error('category_name')
                              <span class="text-danger">{{$message}}</span>
                          @enderror  
                        </div>
                        <button type="submit" class="btn btn-primary">Edit Categories</button>
                      </form>
                    </div>
                  </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
