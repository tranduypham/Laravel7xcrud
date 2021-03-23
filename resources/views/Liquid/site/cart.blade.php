@extends('Liquid.layouts.main')

@section('title', 'cart')
@section('image', 'images/bg_2.jpg')
@section('page-name', 'products')



@section('content')
    {{-- @if (session('status'))
<div class="alert alert-success">{{ session("status") }}</div>
@endif --}}
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="table-wrap">
                    <table class="table">
                        <thead class="thead-primary">
                            <tr>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>total</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @include("Liquid.site.cart-table")
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Cart Totals</h3>
                        <p class="d-flex">
                            <span>Subtotal</span>
                            <span id="total">${{ number_format($subTotal + $discount, 2, ',', '.') }}</span>
                        </p>
                        <p class="d-flex">
                            <span>Delivery</span>
                            <span id="delevery">$0.00</span>
                        </p>
                        <p class="d-flex">
                            <span>Discount</span>
                            <span id="discount">${{ number_format($discount, 2, ',', '.') }}</span>
                        </p>
                        <hr>
                        <p class="d-flex total-price">
                            <span>Total</span>
                            <span id="subTotal">${{ number_format($subTotal, 2, ',', '.') }}</span>
                        </p>
                    </div>
                    <p class="text-center"><a href="#"
                            class="btn btn-primary py-3 px-4 proceed">Proceed to Checkout</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('css')
@endsection

@section('js')
    <script>
        $(document).ready(function() {

            function check_id(){
                // console.log();
                let checked = $("input[type='checkbox']:checked");
                let checked_id = new Array();
                checked.each(function(){
                    checked_id.push($(this).data("id"));
                });
                return checked_id;
            }

            function updateBill(array) {
                $.ajax({
                    url:"{{ route('Liquid.array') }}",
                    data:{
                        array: array
                    },
                    success: function(data){
                        console.log(data)
                    }
                })
                $.ajax({
                    url: "{{ route('Liquid.cart.bill') }}",
                    type: "GET",
                    // data:{
                    //     array: array
                    // },
                    success: function(data) {
                        console.log(data);
                        $("#subTotal").text("$" + data["subTotal"]);
                        $("#discount").text("$" + data["discount"]);
                        $("#total").text("$" + (data["subTotal"] + data["discount"]));
                    }
                });
            }


            var arr_id = check_id();
            updateBill(arr_id);

            $("tbody").on("click", "input[type='checkbox']", function() {
                console.log("check");
                arr_id = check_id();
                updateBill(arr_id);
            })

            $("tbody").on("change", "input[name='quantity']", function() {
                // alert($(this).data("id"));
                val = $(this).val();
                if (val > 0) {
                    id = $(this).data("id");
                    quantity = $(this).val();
                    $.ajax({
                        url: "{{ route('Liquid.cart.update') }}",
                        type: "GET",
                        data: {
                            id: id,
                            quantity: quantity
                        },
                        success: function(data) {
                            $("tbody").html(data);
                            updateBill();
                        },
                    });
                } else {
                    $(this).val(1);
                }
            });

            $("body").on("click", "td button.close", function() {
                id = $(this).data("id");
                $.ajax({
                    url: "{{ route('Liquid.cart.remove') }}",
                    type: "GET",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        // $("tbody").html(data);
                        alert("Xóa thành công");
                        updateBill();
                    },
                });
            });

            $("a.proceed").on("click",function(event){
                event.preventDefault();
                $.ajax({
                    url: "{{ route('Liquid.array') }}",
                    // type: "POST",
                    data:{
                        array: check_id(),
                        // _token: "{{ csrf_token() }}"
                    },
                    success: function(data){
                        window.location.replace("{{ route("Liquid.checkout") }}");
                    }
                });
            });

        })

    </script>
@endsection
