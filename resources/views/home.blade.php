@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    Namastey {{auth()->user()->name}}ji,
                </div>

                <div class="card-footer">
                    @if( auth()->user()->role == null )

                    @elseif(auth()->user()->role->slug=='admin')
                    <a class='btn btn-primary' href='/backend/add-manager'>Add new manager</a>
                    <a class='btn btn-primary' href='/backend/add-employee'>Add new employee</a>
                    <a class='btn btn-primary' href='/backend/add-food'>Add new food item</a>
                    @elseif( auth()->user()->role->slug == 'manager')
                    <a class='btn btn-primary' href='/backend/add-employee'>Add new employee</a>
                    <a class='btn btn-primary' href='/backend/add-food'>Add new food item</a>
                    @elseif( auth()->user()->role->slug == 'employee')


                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection