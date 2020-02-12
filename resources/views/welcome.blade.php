@extends('layouts.app')

@section('content')
<div class="container">



    <h2>Foods</h2>
    <hr>
    @if($foods->count()==0)
    <div class="jumbotron">
        <p>No products added. Please check back later.</p>
    </div>
    @endif
    <div class="row justify-content-center">
        @foreach($foods as $food)
        <div class="col-md-4">
            <div class="card m-1">
                <img class="card-img-top align-self-center mt-2" style='width:80px' src="{{asset($food->image)}}">
                <div class="card-body">
                    <h4 class="card-title">{{$food->name}}</h4>
                    <h6 class="card-subtitle mb-2 text-muted">${{$food->price}}</h6>
                    <a href="/add-to-cart/{{$food->id}}" class="card-link">Add to cart <i class="fas fa-shopping-cart"></i> </a>
                    @can('modify')
                    <a href="#" class="card-link text-primary">Edit</a>
                    <a href="{{route('delete-food',$food->id)}}" id class="card-link text-danger">Delete</a>

                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{$foods->links()}}
</div>


@endsection