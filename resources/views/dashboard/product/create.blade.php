@extends('layouts.admin.nav')
@section('main-content')
    <div class="row">
        <div class="col-3 offset-8">
            <a href="{{ route('product#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
        </div>
    </div>
    <div class="col-lg-6 offset-3">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2">Product Create Form</h3>
                </div>
                <hr>
                <form action="{{ route('product#store') }}" method="post" enctype="multipart/form-data"
                    novalidate="novalidate">
                    @csrf
                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Name</label>
                        <input id="cc-pament" name="productName" type="text" class="form-control" aria-required="true"
                            aria-invalid="false" placeholder="Seafood..." value="{{ old('productName') }}">
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
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                        <input id="cc-pament" name="productPrice" type="text" class="form-control" aria-required="true"
                            aria-invalid="false" placeholder="Enter Price...." value="{{ old('productPrice') }}">
                        @error('productPrice')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                        <input id="cc-pament" name="productWaitingTime" type="number" class="form-control"
                            aria-required="true" aria-invalid="false" placeholder="Enter Waiting Time...."
                            value="{{ old('productWaitingTime') }}">
                        @error('productWaitingTime')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Description</label>
                        <textarea id="cc-pament" name="productDescription" class="form-control" style="height:8em;" aria-required="true"
                            aria-invalid="false" placeholder="Enter Description" value="">{{ old('productDescription') }}</textarea>
                        @error('productDescription')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Picture</label>
                        <input id="cc-pament" name="image" type="file" class="form-control" aria-required="true"
                            aria-invalid="false" placeholder="Enter Price....">
                        @error('image')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            <span id="payment-button-amount">Create</span>
                            <span id="payment-button-sending" style="display:none;">Sending…</span>
                            <i class="fa-solid fa-circle-right"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
