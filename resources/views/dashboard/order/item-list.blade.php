@extends('layouts.admin.nav')
@section('main-content')
    <div class="col-md-12">
        <!-- DATA TABLE -->

        <div class="row d-flex">
            <a href="{{ URL::previous() }}" class="d-inline col-1 mt-3">
                <i class="fa-solid fa-arrow-left text-dark fa-lg"></i>
            </a>
            <h4 class="pr-4 d-inline col-2 offset-9">Total-({{ $orderItems->total() }})</h4>
        </div>

        <div class="row d-flex">
            <div class="card  mt-2" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title">Order Detail</h5>
                  <hr>
                    Customer : {{ $order->user_name }} <br>
                    Order : {{ $order->order_code }} <br>
                    Date : {{ $order->created_at->format('F-j-Y') }} <br>
                    Total Cost : {{ $order->total_price }}<br>
                  <small class="text-warning">including delivery fee</small>
                </div>
              </div>
        </div>

    </div>

    <div class="table-responsive table-responsive-data2">
        <table class="table table-data2 text-center">
            @if (count($orderItems) != 0)
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderItems as $key => $item)
                        <tr class="tr-shadow">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->product_name }}</td>
                            <td><img src="/storage/images/pizza_images/{{ $item->product_image }}" style="width: 70px;height:80px;" alt=""></td>
                            <td>{{ $item->qty }}</td>
                            <td>{{ $item->total }}</td>
                        </tr>
                        <tr class="spacer"></tr>
                    @endforeach
                @else
                    <h1 class="text-center text-secondary p-5">There is any Order</h1>
            @endif

            </tbody>
        </table>
        {{ $orderItems->links() }}
    </div>
    <!-- END DATA TABLE -->
    </div>
@endsection

