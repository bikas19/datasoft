@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Place your order now...
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>Your order details</h2>
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
                                        <td>{{$item->quantity}}</td>
                                        <td>${{$item->total}}</td>
                                        @php
                                        $total+= $item->total;
                                        @endphp
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
                            <p>To modify order details. Please go to <a href="/cart">cart.</a>
                            </p>
                        </div>

                        <div class="col-md-6">
                            <form action="/place-order" method="POST">
                                @csrf
                                <h2>Delivery and card details</h2>
                                <div class="form-group">
                                    <label for="type">Delivery Type</label>
                                    <select required class="form-control" name='delivery_type' id="delivery-type">
                                        <option value='pickup'>STORE PICKUP</option>
                                        <option value='deliver'>Deliver to address</option>

                                    </select>
                                </div>
                                <div id='delivery_address' class="form-group">
                                    <label for="">Deliver to (full address)</label>
                                    <textarea name='address' class='form-control'>

                        </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Credit Card Details</label>
                                    <div class=" form-group row">
                                        <input required type="text" placeholder="Credit Card Number" class="form-control col-md-6">
                                        <input required type="text" placeholder="Expiry Date" class="form-control col-md-3">
                                        <input required type="text" placeholder="CVV" class="form-control col-md-3">


                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Cardholder Name</label>
                                    <input name='cardholder_name' required type="text" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="">Cardholder Address</label>
                                    <input name='cardholder_address' required type="text" class="form-control">
                                </div>
                                <button type="submit" class='btn btn-lg btn-danger'>
                                    Place Order
                                </button>
                            </form>
                        </div>
                    </div>


                </div>


            </div>

        </div>

    </div>

</div>

@endsection

@section('scripts')

<script>
    var val = $("#delivery-type").val();

    if (val === 'pickup') {
        $("#delivery_address").hide();
    } else if (val === 'deliver') {
        $("#delivery_address").show();
    };
    $("#delivery-type").on('change', function() {
        var val = $(this).val();
        if (val === 'pickup') {
            $("#delivery_address").hide();
        } else if (val === 'deliver') {
            $("#delivery_address").show();
        }
    });
</script>
@endsection