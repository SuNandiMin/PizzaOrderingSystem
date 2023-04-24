@extends('layouts.admin.master')

@section('content')
    <div class="col-lg-10 offset-1 mt-5">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2">Profile</h3>
                </div>
                <strong>
                    <hr class="text-primary">
                </strong>
                <div class="row">
                    <div class="col-10 offset-1">
                        <form action="{{ route('profile#update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row ">
                                <div class="col-4">
                                    @if (!Auth::user()->image == null)
                                        <img rounded-circle" style="height: 170px"
                                            src="{{ asset('storage/images/profile_images/' . Auth::user()->image) }}"
                                            alt="">
                                    @else
                                        <img style="height: 170px; width:170px;"
                                            src="{{ asset('images/profile-images/default.png') }}" alt="John Doe" />
                                    @endif
                                    <input type="file" class="form-control" name="image" id="">
                                </div>
                                <div class="col-7 pl-4">
                                    <div class="login-form">

                                        <div class="form-group">
                                            <label>Username</label>
                                            <input class="au-input au-input--full" type="text" name="name"
                                                value="{{ old('name', Auth::user()->name) }}" placeholder="Username">
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input class="au-input au-input--full" type="email" name="email"
                                                value="{{ old('email', Auth::user()->email) }}" placeholder="Email">
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input class="au-input au-input--full" type="text" name="phone"
                                                value="{{ old('phone', Auth::user()->phone) }}" placeholder="09*********">
                                            @error('phone')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Address</label>
                                            <input class="au-input au-input--full" type="text" name="address"
                                                value="{{ old('address', Auth::user()->address) }}" placeholder="Address">
                                            @error('address')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="d-flex col-4 offset-1 justify-content-around">
                                        <a class="au-btn au-btn--block bg-danger m-b-20 text-white" href="{{ URL::previous() }}">
                                            <i class="fa-regular fa-circle-xmark fa-lg pr-2"
                                                style="color: #ffffff;"></i>Cancle</a>
                                    </div>
                                    <div class="d-flex col-6 justify-contbg-dangerent-around">
                                        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit"><i
                                                class="fa-solid fa-lg fa-cloud-arrow-up pr-2"></i>Update Profile </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <strong class="text-primary">
                        <hr>
                    </strong>
                </div>
            </div>
        </div>
    </div>
@endsection
