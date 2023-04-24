@extends('layouts.admin.nav')
@section('main-content')
    <div class="container">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class=" row card-title">
                        <div class="col-1 offset-1 mt-3">
                            <i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;" onclick=" history.back()"></i>
                        </div>
                        <div class="col offset-3">
                            <h3 class="text-secondary title-2">Product Details</h3>
                        </div>
                    </div>
                    <strong class="text-primary">
                        <hr>
                    </strong>
                    <div class="row">
                        <div class="col-4">
                            <img src="{{ asset('storage/images/pizza_images/' . $product->image) }}" class="rounded mt-3 mb-5"
                                style="width: 300px;height:350px;" alt="">
                        </div>
                        <div class="col-8">
                            <h3 class="">{{ $product->name }}</h3>
                            <div class="mb-4">
                                <span class="me-1 btn btn-dark text-white text-center"><i
                                        class="fa-solid fa-window-restore fa-lg" style="color: #bb96c5;"></i>
                                    {{ $product->category_name }}</span>
                                <span class="me-1 btn btn-dark text-white text-center"><i
                                        class="fa-solid fa-money-bill fa-lg" style="color: #2556ad;"></i>
                                    {{ $product->price }}</span>
                                <span class="me-1 btn btn-dark text-white text-center"><i
                                        class="fa-solid fa-clock-rotate-left fa-lg" style="color: #c78022;"></i>
                                    {{ $product->waiting_time }} - h</span>
                                <span class="me-1 btn btn-dark text-white text-center"><i class="fa-regular fa-eye fa-lg"
                                        style="color: #898c92;"></i> {{ $product->view_count }}</span>
                                <span class="me-1 btn btn-dark text-white text-center"><i
                                        class="fa-regular fa-calendar-check fa-lg" style="color: #5f75ce;"></i>
                                    {{ $product->created_at->format('j m Y') }}</span>
                            </div>
                            <div class="row">
                                <i class="fa-solid fa-file-lines fa-2xl" style="color: #2b9216;"></i><br>
                                <p class="">
                                    {{ $product->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
