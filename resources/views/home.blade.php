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
                    <button class='btn btn-primary'>Add new manager</button>
                    <button class='btn btn-primary'>Add new employee</button>
                    <button class='btn btn-primary'>Add new food item</button>
                    @elseif( auth()->user()->role->slug == 'manager')

                    @elseif( auth()->user()->role->slug == 'employee')


                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection