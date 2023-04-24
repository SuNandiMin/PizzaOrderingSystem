@extends('layouts.customer.nav')
@section('main-content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                @if (session('success'))
                    <div class=" d-flex justify-content-center">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                @if (count($carts) != 0)
                    <table class="table table-light table-borderless table-hover mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle" id="dataTable">

                            @foreach ($carts as $cart)
                                <tr>
                                    <td class="align-middle">
                                        <input type="hidden" id="product_id" value="{{ $cart->product_id }}">
                                        <img src="{{ asset('storage/images/pizza_images/' . $cart->product_image) }}"
                                            alt="" style="width: 50px;" class="mr-2">{{ $cart->product_name }}
                                    </td>
                                    {{-- <input type="hidden" name="" id="price" value="{{ $cart->product_price }}"> --}}
                                    <td class="align-middle " id="price">{{ $cart->product_price }} Kyats</td>
                                    <td class="align-middle">
                                        <div class="input-group quantity mx-auto" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-minus">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text"
                                                class="form-control form-control-sm bg-secondary border-0 text-center"
                                                value="{{ $cart->qty }}" id="qty">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-primary btn-plus">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle" id="total">{{ $cart->product_price * $cart->qty }} Kyats
                                    </td>
                                    <td class="align-middle"><a class="btn btn-sm btn-danger btnRemove"
                                            {{-- href="{{ route('cart#delete', $cart->id) }}" --}}>
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                @elseif (count($carts) == 0)
                    <h1 class="mt-5 pt-5 text-capitalize text-lg-center">
                        Your Cart iz Clear
                    </h1>
                @endif

            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotalPrice">{{ $total }} Kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Deli fee</h6>
                            <h6 class="font-weight-medium">3000 - Kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="allTotalPrice">{{ $total + 3000 }} Kyats</h5>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btnClear btn btn-block btn-danger font-weight-bold m-3 py-3 rounded">Clear
                                Cart</button>
                            <button class="btn btn-block btn-success font-weight-bold m-3 py-3 rounded"
                                id="order">Order</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('jsSource')
    {{-- changes in carts page like click +- buttons --}}
    <script src="{{ asset('customer/js/cart.js') }}"></script>

    {{-- when click order btn --}}
    <script>
        $(document).ready(function() {
            $('#order').click(function() {
                // $totalPrice = 0;

                $orderList = [];
                $random = Math.floor(Math.random() * 100001);
                $date = new Date().toISOString().slice(0, 10);

                $('#dataTable tr').each(function(index, row) {
                    $orderList.push({
                        'product_id': $(row).find('#product_id').val(),
                        'total': $(row).find('#total').text().replace("Kyats", "") * 1,
                        'qty': $(row).find('#qty').val(),
                        'code': 'Ord-' + $random + '-' + $date,
                    });
                });
                $.ajax({
                    type: 'get',
                    url: '/pizza/order/create',
                    dataType: 'json',
                    data: Object.assign({}, $orderList),
                    success: function(response) {
                        if (response.status == "success") {
                            window.location.href = "/pizza";
                        }
                    }
                })
            })

            $('.btnClear').click(function() {
                $('#dataTable tr').remove();

                $("#subTotalPrice").html(`0 Kyats`);
                $("#allTotalPrice").html(`3000 Kyats`);

                $.ajax({
                    type:'get',
                    url:'/pizza/cart/clear-all',
                    dataType:'json',
                    success:function(response){
                        location.reload()
                    }
                })
            })
        })
    </script>
@endsection
