@extends('layouts.admin.nav')
@section('main-content')
    <div class="col-md-12">
        <!-- DATA TABLE -->
        <div class="table-data__tool">
            <div class="table-data__tool-left">
                <div class="overview-wrap">
                    <form class="form-header" action="{{ route('order#list') }}">
                        <input class="au-input au-input--xl" type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search with order code..." />
                        <button class="btn btn-sm btn-outline-primary au-btn--submit" type="submit">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="table-data__tool-right">
                <form action="{{ route('order#list') }}">
                    <div class="input-group mb-3" style="width:30ex">
                        {{-- <input type="text"  placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1"> --}}
                        <select name="statusForFilter" class="form-select au-btn--small mb-3 form-control"
                            aria-label=".form-select-lg example" id="filter-status">
                            <option value="">All Order</option>
                            <option value="0" @if (request("statusForFilter") == "0") selected @endif>Pending</option>
                            <option value="1" @if (request("statusForFilter") == "1") selected @endif>Success</option>
                            <option value="2" @if (request("statusForFilter") == "2") selected @endif>Reject</option>
                        </select>
                        <button class="btn btn-sm btn-success au-btn--submit" style="width:37px; height:37px;" type="submit"><i
                                class="zmdi zmdi-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row justify-content-end">
            <h4 class="pr-4" id="totalCount">Total-({{ $orders->total() }})</h4>
        </div>
    </div>

    <div class="table-responsive table-responsive-data2">
        <table class="table table-data2 text-center" id="dataTable">
            @if (count($orders) != 0)
                <thead>
                    <th>No.</th>
                    <th>Order Code</th>
                    <th>Customer Name</th>
                    <th>Cost</th>
                    <th>Order Date</th>
                    <th>status</th>
                </thead>
                </thead>
                <tbody id="dataRows">
                    @foreach ($orders as $key => $order)
                        <tr class="tr-shadow">
                            <td>{{ $key + 1 }}</td>
                            <td class="">
                                <a href="{{ route('order#item#list', $order->order_code) }}"
                                    class="order-code text-decoration-none text-primary">
                                    {{ $order->order_code }}
                                </a></td>
                            <td>{{ $order->user_name }}</td>
                            <td>{{ $order->total_price }}</td>
                            <td>{{ $order->created_at->format('F-j-Y') }}</td>
                            <td>
                                <select name="" class="order-status form-control w-75">
                                    <option value="0" @if ($order->status == '0') selected @endif>Pending
                                    </option>
                                    <option value="1" @if ($order->status == '1') selected @endif>Success
                                    </option>
                                    <option value="2" @if ($order->status == '2') selected @endif>Reject
                                    </option>
                                </select>
                            </td>
                        </tr>
                        <tr class="spacer"></tr>
                    @endforeach
                @else
                    <h1 class="text-center text-secondary p-5">There is any Order</h1>
            @endif

            </tbody>
        </table>
        {{ $orders->links() }}
    </div>
    <!-- END DATA TABLE -->
    </div>
@endsection

@section('js-script')
    <script>
        $(document).ready(function() {

            $('.order-status').change(function() {
                $parentNode = $(this).parents("tr");
                $order_code = $parentNode.find('.order-code').html();
                $status = $(this).val();

                console.log($order_code);

                $.ajax({
                    type: 'get',
                    url: '/dashboard/orders/change-status',
                    dataType: 'json',
                    data: {
                        status: $status,
                        orderCode: $order_code,
                    },
                    success: function(response) {
                        // location.reload();
                    }
                })

            })


            //filter by status
            // $('#filter-status').change(function() {

            //     $.ajax({
            //         type: 'get',
            //         url: '/dashboard/orders/',
            //         dataType: 'json',
            //         data: {
            //             status: $('#filter-status').val(),
            //         },
            //         success: function(response) {
            //             console.log(response);
            //             $list = '';
            //             for ($i = 0; $i < response.length; $i++) {

            //                 $months = ['January', 'February', 'March', 'Apirl', 'May', 'June',
            //                     'July', 'August', 'September', 'October', 'November',
            //                     'December'
            //                 ];
            //                 $getDate = new Date(response[$i].created_at);

            //                 $list += `
        //             <tr class="tr-shadow" >
        //             <td>${$i+1}</td>
        //             <td class="order-code">${response[$i].order_code}</td>
        //             <td>${response[$i].total_price}</td>
        //             <td>${$months[$getDate.getMonth()] +'-'+ $getDate.getDate() +'-'+ $getDate.getFullYear()}</td>
        //             <td>
        //                 <select name="" class="order-status form-control w-75">
        //                         <option value="0" ${ response[$i].status == 0 ? "selected" : "" } >Pending</option>
        //                         <option value="1" ${ response[$i].status == 1 ? "selected" : "" } >Success</option>
        //                         <option value="2" ${ response[$i].status == 2 ? "selected" : "" } >Reject</option>
        //                 </select>
        //             </td>
        //             <td>
        //                 <a href=""
        //                     class=" text-decoration-none text-primary">
        //                     <i class="fa-solid fa-circle-info"></i> Detail
        //                 </a>
        //             </td>
        //         </tr>
        //         <tr class="spacer"></tr>
        //             `
            //             }
            //             $('#dataRows').html($list);
            //             $('#totalCount').html('Total-(' + response.length + ')')
            //         }
            //     })
            // })

        })
    </script>
@endsection
