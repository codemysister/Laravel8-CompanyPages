@extends('admin.admin_master')
@section('admin')

<div class="row">
    <div class="col-lg">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Add About</h2>
            </div>
            <div class="card-body">
                <form action="{{url('store/about/')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Title</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Title" name="title">
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Short Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="short_desc"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Long Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="long_desc"></textarea>
                    </div>
                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Submit</button>
                    </div>
                </form>
            </div>
        </div>
@endsection