@extends('layouts.customer.nav')
@section('main-content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-10 offset-1 table-responsive mb-5">
                @if (count($orders) != 0)
                    <table class="table table-light table-border border table-hover  mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Order Code</th>
                                <th>Total Price</th>
                                <th>Order Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle" id="dataTable">
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->order_code }}</td>
                                    <td>{{ $order->total_price }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        @if ($order->status == '0')
                                            <div class="text-primary">
                                                <i class="fa-solid fa-clock-rotate-left"></i> pending...
                                            </div>
                                        @elseif ($order->status == '1')
                                            <div class="text-success">
                                                <i class="fa-solid fa-check"></i> Success
                                            </div>
                                        @elseif ($order->status == '2')
                                            <div class="text-danger">
                                                <i class="fa-solid fa-xmark"></i> Reject
                                            </div>
                                        @endif

                                    </td>
                                    <td>
                                        <a href="{{ route('order#detail', $order->order_code) }}"
                                            class="btn btn-success">More</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                @elseif (count($orders) == 0)
                    <h1 class="mt-5 pt-5 text-capitalize text-lg-center">
                        There is no orders in your cart
                    </h1>
                @endif

            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
