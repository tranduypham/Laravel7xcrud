@extends('Liquid.layouts.main')

@section('title', 'checkout')
@section('image', 'images/bg_2.jpg')
@section('page-name', 'products')



@section('content')
@foreach ($errors->all() as $message)
{{ $message }}
@endforeach
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 ftco-animate">
                    <form action="{{ route("Liquid.checkout.store") }}" class="billing-form" method="POST">
                        @csrf
                        <h3 class="mb-4 billing-heading">Billing Details</h3>
                        <div class="row align-items-end">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname">Firt Name</label>
                                    <input type="text" class="form-control" placeholder="" name="first_name" value="{{ old("first_name") }}">
                                </div>
                                @error('first_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" class="form-control" placeholder="" name="last_name" value="{{ old("last_name") }}">
                                </div>
                                @error('last_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="w-100"></div>
                            {{-- <div class="col-md-12">
                                <div class="form-group">
                                    <label for="country">State / Country</label>
                                    <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <select name="" id="" class="form-control">
                                            <option value="">France</option>
                                            <option value="">Italy</option>
                                            <option value="">Philippines</option>
                                            <option value="">South Korea</option>
                                            <option value="">Hongkong</option>
                                            <option value="">Japan</option>
                                        </select>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="streetaddress">Street Address</label>
                                    <input type="text" class="form-control" placeholder="House number and street name"
                                        name="address" value="{{ old("address") }}">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control"
                                        placeholder="Appartment, suite, unit etc: (optional)" name="address_opt" value="{{ old("address_opt") }}">
                                </div>
                            </div>
                            @error('address')
                                <div class="text-danger col-md-12">{{ $message }}</div>
                            @enderror
                            <div class="w-100"></div>
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="towncity">Town / City</label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                            </div> --}}
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="postcodezip">Postcode / ZIP *</label>
                                    <input type="text" class="form-control" placeholder="">
                                </div>
                            </div> --}}
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" placeholder="" name="phone" value="{{ old("phone") }}">
                                </div>
                                @error("phone")
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="emailaddress">Email Address</label>
                                    <input type="text" class="form-control" placeholder="" name="email" value="{{ old("email") }}">
                                </div>
                                @error("email")
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="w-100"></div>
                            {{-- <div class="col-md-12">
                                <div class="form-group mt-4">
                                    <div class="radio">
                                        <label class="mr-3"><input type="radio" name="optradio"> Create an Account? </label>
                                        <label><input type="radio" name="optradio"> Ship to different address</label>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="note">Note</label>
                                    <textarea name="note" id="" cols="30" rows="10" class="form-control">{{ old("note") }}"</textarea>
                                </div>
                                @error("note")
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" name="payment-method">
                    </form><!-- END -->



                    <div class="row mt-5 pt-3 d-flex">
                        <div class="col-md-6 d-flex">
                            <div class="cart-detail cart-total p-3 p-md-4">
                                <h3 class="billing-heading mb-4">Cart Total</h3>
                                <p class="d-flex">
                                    <span>Subtotal</span>
                                    <span id="total">$20.60</span>
                                </p>
                                <p class="d-flex">
                                    <span>Delivery</span>
                                    <span id="delevery">$0.00</span>
                                </p>
                                <p class="d-flex">
                                    <span>Discount</span>
                                    <span id="discount">$3.00</span>
                                </p>
                                <hr>
                                <p class="d-flex total-price">
                                    <span>Total</span>
                                    <span id="subTotal">$17.60</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="cart-detail p-3 p-md-4">
                                <h3 class="billing-heading mb-4">Payment Method</h3>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label><input type="radio" name="radio" class="mr-2" value="Direct Bank Tranfer"> Direct Bank
                                                Tranfer</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label><input type="radio" name="radio" class="mr-2" value="COD"> COD</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label><input type="radio" name="radio" class="mr-2" value="Paypal">
                                                Paypal</label>
                                        </div>
                                    </div>
                                </div>
                                {{--  <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="" class="mr-2"> I have read and accept the
                                                terms and conditions</label>
                                        </div>
                                    </div>
                                </div>  --}}
                                <p><a href="#" class="btn btn-primary py-3 px-4 check-out">Place an order</a></p>
                            </div>
                        </div>
                    </div>
                </div> <!-- .col-md-8 -->
            </div>
        </div>
    </section>
@endsection

@section('css')
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            function updateBill() {
                $.ajax({
                    url: "{{ route('Liquid.cart.bill') }}",
                    type: "GET",
                    success: function(data) {
                        console.log(data);
                        $("#subTotal").text("$" + data["subTotal"]);
                        $("#discount").text("$" + data["discount"]);
                        $("#total").text("$" + (data["subTotal"] + data["discount"]));
                    }
                })
            };
            updateBill();

            $("a.check-out").on("click",function(event){
                event.preventDefault();
                $("form.billing-form").submit();
            });

            $(".cart-detail").on("click","input[type='radio']",function(){

                // console.log();
                method = $(this).val();
                $("input[name='payment-method']").val(method);

            });
        })

    </script>
@endsection
