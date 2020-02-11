@extends('layouts.app')


@section('content')

<div class="container">
@foreach ($errors->all() as $message) 
<p class='alert alert-danger'>{{$message}}</p>
@endforeach
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add new food item</div>
                <div class="card-body">
                    @if(session('message'))
                <div class="alert alert-primary">
                    {{session('message')}}
                </div>
                    @endif
                    <form action="" method="post" enctype="multipart/form-data"> 
                        @csrf 
                        <div class="form-group">
                            <label for="Name">Name of food item</label>
                            <input type="text" value='{{old("name")}}' name='name' class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="Name">Description of food item</label>
                            <textarea name='description' class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="Name">Category of food item</label>
                            <div class="row justify-content-between">
                                <div class="col-md-4">
                                    <select name="category_id" class='form-control'>
                                        <option value="-1">Create new category</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>

                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <span class='text-large'>if create new category selected </span>
                                </div>
                                <div class="col-md-5">
                                    <input class='form-control' type="text" placeholder="Enter category name here." name='other_category'>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Name">Price of food item</label>
                            <input type="text" value='{{old("price")}}' name='price' class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="Name">Components of food item</label>
                            <input type="text" value='{{old("components")}}' name='components' class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="Name">Image of food item</label>
                            <input type="file" name='image' class="form-control-file">
                        </div>

                        <button type='submit' class='btn btn-primary'>Submit</button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection