@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadowed">
                <div class="card-header">
                    Your Cart <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Food</th>
                                <th>Rate</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($items->count()==0)
                            <tr>
                                <td colspan="5">
                                    <p class="alert alert-info">Cart is empty. Please go to <a href="/">shop</a> to add to cart.</p>
                                </td>
                            </tr> @endif
                            @php
                            $total=0;
                            @endphp
                            @foreach($items as $index=>$item)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td> <a href="{{route('food.show',$item->food_id)}}">{{$item->food->name}}</a> </td>
                                <td>{{$item->rate}}</td>
                                <td><input type="number" placeholder="qty" class='qty form-control w-50' data-id='{{$item->id}}' value="{{$item->quantity}}"></td>
                                <td>${{$item->total}}</td>
                                @php
                                $total+= $item->total;
                                @endphp
                                <td class="d-none">
                                    <form method="POST" action="/cart/{{$item->id}}" style="display:none">
                                        @csrf
                                        <input type="text" class="" name='qty' id='cartitem-{{$item->id}}'>
                                        <input type="submit" id='cartsubmit-{{$item->id}}'>
                                    </form>
                                </td>
                                <td>
                                    <a class='btn btn-sm btn-danger' href="/cart/{{$item->id}}/delete">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                        <tfoot>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Grand Total</th>
                            <th>${{$total}}</th>
                        </tfoot>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="#" class='btn btn-danger float-right'>Place Order Now</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $('.qty').on('change', function() {
        var id = $(this).data('id');
        $("#cartitem-" + id).val($(this).val());
        $("#cartsubmit-" + id).click();
    })
</script>
@endsection