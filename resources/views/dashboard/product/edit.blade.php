@extends('layouts.admin.nav')
@section('main-content')
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row card-title">
                    <div class="col-1 offset-1 mt-3">
                        <a href="{{ route('product#list') }}">
                            <i class="fa-solid fa-arrow-left fa-lg" style="color: #000000;"></i>
                        </a>
                    </div>
                    <div class="col offset-3">
                        <h3 class="text-secondary title-2">Product Edit Form</h3>
                    </div>
                </div>
                <hr>
                <form action="{{ route('product#update') }}" method="post" enctype="multipart/form-data"
                    novalidate="novalidate">
                    @csrf
                    <div class="row">

                        <div class="col-4">
                            <div class="form-group">
                                <img src="{{ asset('storage/images/pizza_images/' . $product->image) }}" class="rounded-top"
                                    style="width: 300px;height:250px;" alt="">
                                <input id="cc-pament" name="image" type="file" class="form-control"
                                    style="width: 300px;" aria-required="true" aria-invalid="false"
                                    placeholder="Seafood...">
                                @error('image')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-7">

                            <input type="hidden" name="ID" value="{{ $product->id }}">
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Name</label>
                                <input id="cc-pament" name="productName" type="text" class="form-control"
                                    aria-required="true" aria-invalid="false" placeholder="Seafood..."
                                    value="{{ old('productName', $product->name) }}">
                                @error('productName')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Category</label>
                                <select name="category" class="form-control" id="" value="Choose Category">
                                    <option value="" selected="true" disabled="disabled">Choose Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $category->id == $product->category_id ? 'selected' : ' ' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Price</label>
                                <input id="cc-pament" name="productPrice" type="text" class="form-control"
                                    aria-required="true" aria-invalid="false" placeholder="Enter Price...."
                                    value="{{ old('productPrice', $product->price) }}">
                                @error('productPrice')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                <input id="cc-pament" name="productWaitingTime" type="text" class="form-control"
                                    aria-required="true" aria-invalid="false" placeholder="Enter Waiting Time...."
                                    value="{{ old('productWaitingTime', $product->waiting_time) }}">
                                @error('productWaitingTime')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Description</label>
                                <textarea id="cc-pament" name="productDescription" class="form-control" style="height:8em;" aria-required="true"
                                    aria-invalid="false" placeholder="Enter Description" value="">{{ old('productDescription', $product->description) }}</textarea>
                                @error('productDescription')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Update</span>
                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
                            </div>
                </form>
            </div>
        </div>

    </div>
    </div>
    </div>
@endsection
