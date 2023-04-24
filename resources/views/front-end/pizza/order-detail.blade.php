@extends('layouts.customer.nav')
@section('main-content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-10 offset-1 table-responsive mb-5">
                <div class="col-1 offset-1 m-2">
                    <i class="fa-solid fa-arrow-left fa-xl" style="color: #000000;" onclick=" history.back()"></i>
                </div>
                <table class="table table-light table-border border table-hover text-center mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total Price</th>

                        </tr>
                    </thead>
                    <tbody class="align-middle" id="dataTable">
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ $item->total }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" class="text-right">
                                <h3>Total Price </h3>
                                <h5>{{ $totalPrice }}</h5>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
