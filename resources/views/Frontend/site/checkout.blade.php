@extends('Frontend.layouts.main')

@section('title', 'Trang thanh toan')
@section('head', 'Checkout')

@section('content')
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">

            <div class="checkout__form">
                <h4>Thông tin đơn hàng</h4>
                <form action="{{route("Payment")}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Họ<span>*</span></p>
                                        <input type="text" name="FirstName">
                                        @error('FirstName')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Tên<span>*</span></p>
                                        <input type="text" name="LastName">
                                        @error('LastName')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="checkout__input">
                                <p>Địa chỉ<span>*</span></p>
                                <input type="text" placeholder="Street Address" class="checkout__input__add" name="Address">
                                @error('Address')
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>SDT<span>*</span></p>
                                        <input type="text" name="Phone">
                                        @error('Phone')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" name="Email">
                                        @error('Email')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="checkout__input">
                                <p>Ghi chút đơn hàng<span>*</span></p>
                                <input type="text"
                                    placeholder="Notes about your order, e.g. special notes for delivery." name="Note">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Đơn hàng của bạn</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                    {{-- <li>Sách ngoại ngữ <span>$75.99</span></li>
                                    <li>Sách ngoại ngữ <span>$151.99</span></li>
                                    <li>Sách ngoại ngữ <span>$53.99</span></li> --}}
                                    @foreach($products as $id => $product)
                                    <li>{{$product["name"]}} <span>${{$product["price"]}}</span></li>
                                    @endforeach
                                </ul>
                                <div class="checkout__order__subtotal">Tổng tiền <span>${{$totalPrice}}</span></div>
                                <div class="checkout__order__total">Thanh toán <span>${{$totalPrice}}</span></div>
                                {{-- <input type="hidden" name="totalPrice" value="{{$totalPrice}}"> --}}
                                <button type="submit" class="site-btn">ĐẶT HÀNG</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection
