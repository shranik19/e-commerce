@extends('layout')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- {{dd($items)}} --}}
                                @foreach ($items as $hash => $item)
                                    <tr>
                                        <td class="shoping__cart__item">

                                            <h5>{{ $item->getTitle() }}</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            Rs. {{ $item->getPrice() }}
                                        </td>
                                        <td class="shoping__cart__quantity">

                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input type="text" value="{{ $item->getQuantity() }}">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__total">
                                            Rs. {{ $item->getDetails()->total_price }}
                                        </td>
                                        <td class="shoping__cart__item__close" onclick="deleteCart('{{ $hash }}')">
                                            <span class="icon_close"></span>
                                            <form method="POST" action="/cart/remove" id="deleteForm-{{ $hash }}">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="itemHash" value="{{ $hash }}">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="/products" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <button href="#" class="primary-btn cart-btn cart-btn-right"
                            onclick="updateCart('{{ $hash }}')">
                            <span class="icon_loading"></span>
                            Upadate Cart</button>
                        <form method="POST" action="/cart/update" id="updateForm-{{ $hash }}">
                            @csrf
                            <input type="hidden" value="{{ $hash }}" name="itemHash">
                        </form>

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Subtotal <span>
                                    Rs. {{ $subtotal }}
                                </span></li>
                            <li>Total <span>
                                    Rs. {{ $total }}
                                </span></li>
                        </ul>
                        <a href="/checkout" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
@endsection
@section('scripts')
    <script>
        function deleteCart(hash) {
            let userConfirmation = confirm("Are you sure you want to delete this?");
            if (!userConfirmation) {
                return;
            }
            let form = $('#deleteForm-' + hash);
            form.submit();

        }

        function updateCart(hash) {
            // alert('changed');
            let form = $('#updateCart-' + hash);
            form.submit();
        }
    </script>
@endsection
