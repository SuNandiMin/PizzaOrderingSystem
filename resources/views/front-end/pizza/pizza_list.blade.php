@extends('layouts.customer.nav')
@section('title', 'Home')
@section('main-content')

    {{-- shop Page --}}

    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
                        Category</span></h5>
                <div class="bg-light pt-3">
                    <form>
                        <div class="custom-control d-flex align-items-center justify-content-between">
                            <h4 class="" for="price-all">Categories</h4>
                        </div>
                        <hr>
                        <div class="custom-control d-flex align-items-center justify-content-between mb-2">
                            <a class="text-decoration-none" for="price-1" href="{{ route('pizza#list') }}"><strong>All
                                    Pizza</strong></a>
                        </div>
                        @foreach ($categories as $category)
                            <div class="custom-control d-flex align-items-center justify-content-between mb-2">
                                <a class="text-decoration-none" for="price-1"
                                    href="{{ route('category#filter', $category->id) }}">{{ $category->name }}</a>
                            </div>
                        @endforeach

                    </form>
                </div>
                <!-- Price End -->

            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                            </div>
                            <div class="ml-2">
                                <select name="sorting" id="sorting" class="form-control rounded">
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="dataList">
                        @if (count($products) != 0)
                            @foreach ($products as $product)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid rounded-top" style=""
                                                src="{{ asset('storage/images/pizza_images/' . $product->image) }} "
                                                alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Add to Cart" href=""><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="More Detail" href="{{ route('pizza#detail',$product->id) }}">
                                                    <i class="fa fa-info"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none"  href="">
                                                <h3>{{ $product->name }}</h3>
                                            </a>
                                            <div class="">
                                                <h6 style="color: rgb(238, 159, 41)">{{ $product->category->name }}</h6>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{ $product->price }} - kyats</h5>
                                                {{-- <h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                                            </div>
                                            {{-- <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div> --}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h2 class="text-center">Thres is no pizza <i class="fa-solid fa-pizza-slice fa-2xl"
                                    style="color: #d8ab31;"></i></h2>
                        @endif
                    </div>

                    {{ $products->links() }}

                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

@endsection

@section('jsSource')

    <script>
        $(document).ready(function() {
            $('#sorting').change(function() {
                optionValue = $('#sorting').val();
                    $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/pizza/ajax/sorting',
                        dataType: 'json',
                        data: {
                            'status': optionValue == 'asc' ? 'asc' : 'desc' ,
                        },
                        success: function(response) {
                            $list = '';
                            for ($i = 0; $i < response.length; $i++) {
                                // console.log(response[$i].name);
                                $list += `
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid rounded-top"
                                                src="{{ asset('storage/images/pizza_images/${response[$i].image}') }} "
                                                alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Add to Cart" href=""><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="More Detail" href="{{ url('pizza/detail/${response[$i].id}') }}">
                                                    <i class="fa fa-info"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4" >
                                            <a class="h6 text-decoration-none" href="">
                                                <h2 >${response[$i].name}</h2>
                                            </a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${response[$i].price} - kyats</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `
                            }
                            $('#dataList').html($list);
                        }

                    })

            })
        });
    </script>

@stop
