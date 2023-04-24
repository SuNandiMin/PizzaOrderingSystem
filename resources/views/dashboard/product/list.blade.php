@extends('layouts.admin.nav')

@section('main-content')
    {{-- <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">overview</h2>
            </div>
        </div>
    </div>
    <div class="row m-t-25">
        <div class="col-sm-6 col-lg-3">
            <div class="overview-item overview-item--c1">
                <div class="overview__inner">
                    <div class="overview-box clearfix">
                        <div class="icon">
                            <i class="zmdi zmdi-account-o"></i>
                        </div>
                        <div class="text">
                            <h2>200</h2>
                            <span>Customers</span>
                        </div>
                    </div>
                    <div class="overview-chart">
                        <canvas id="widgetChart1"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="overview-item overview-item--c2">
                <div class="overview__inner">
                    <div class="overview-box clearfix">
                        <div class="icon">
                            <i class="zmdi zmdi-shopping-cart"></i>
                        </div>
                        <div class="text">
                            <h2>100</h2>
                            <span>Order Number</span>
                        </div>
                    </div>
                    <div class="overview-chart">
                        <canvas id="widgetChart2"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="overview-item overview-item--c4">
                <div class="overview__inner">
                    <div class="overview-box clearfix">
                        <div class="icon">
                            <i class="zmdi zmdi-money"></i>
                        </div>
                        <div class="text">
                            <h2>100000</h2>
                            <span>total earnings</span>
                        </div>
                    </div>
                    <div class="overview-chart">
                        <canvas id="widgetChart4"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="row">
        <div class="col-md-12">
            <div class="">
                @if (session('success'))
                    <div class=" d-flex justify-content-end">
                        <div class="alert alert-info text-center alert-dismissible fade show" style="width: 30rem;"
                            role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif

                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap" style="width:100px;">
                            <form class="form-header" action="{{ route('product#list') }}">
                                <input class="au-input au-input--xl" type="text" name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Search for Pizza name &amp; price &amp; description..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('product#create') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add item
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <h4 class="pr-4">Total-({{ $products->total() }})</h4>
                </div>
            </div>

            <div class="table-responsive table-responsive-data2">
                <table class="table table-data2">
                    @if (count($products) != 0)
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>ID</th>
                                <th>name</th>
                                <th>categoty</th>
                                <th>price</th>
                                <th>waiting time</th>
                                <th>Picture</th>
                                <th>description</th>
                                <th>date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $product)
                                <tr class="tr-shadow">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->waiting_time }} - min</td>
                                    <td>
                                        @if ($product->image != null)
                                            <img src="{{ asset('storage/images/pizza_images/' . $product->image) }}"
                                                alt="" style="height: 60px; width:90px;">
                                        @else
                                            <p>No image for this Pizza</p>
                                        @endif
                                    </td>
                                    <td>{{ Str::words($product->description, 5, '...') }}</td>
                                    <td>{{ $product->created_at->format('d M Y') }}</td>
                                    <td>
                                        <div class="table-data-feature">
                                            <button class="item" data-toggle="tooltip" data-placement="top"
                                                title="Send">
                                                <i class="zmdi zmdi-mail-send text-secondary"></i>
                                            </button>

                                            <button class="item" data-toggle="tooltip" data-placement="top"
                                                title="More">
                                                <a href="{{ route('product#show', $product->id) }}">

                                                    <i class="fa-solid fa-file-lines fa-sm" style="color: #2b9216;"></i>
                                                </a>
                                            </button>

                                            <button class="item" data-toggle="tooltip" data-placement="top"
                                                title="Edit">
                                                <a href="{{ route('product#edit', $product->id) }}">

                                                    <i class="zmdi zmdi-edit text-primary"></i>
                                                </a>
                                            </button>

                                            <form action="{{ route('product#delete', $product->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="item" data-toggle="tooltip" data-placement="top"
                                                    title="Delete">
                                                    <i class="zmdi zmdi-delete text-danger"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="spacer"></tr>
                            @endforeach
                        @else
                            <h1 class="text-center text-secondary p-5">There is any Pizza </h1>
                    @endif
                    </tbody>
                </table>
                {{ $products->links() }}
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>
@stop
