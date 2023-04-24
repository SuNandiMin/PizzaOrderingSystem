@extends('layouts.admin.master')

@section('content')
    <div class="col-lg-10 offset-1 mt-5">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex ">
                    <a href="{{ URL::previous() }}" class=""><i class="fa-solid fa-arrow-left fa-xl" style="color: #0b0c0e;"></i></a>
                    <h3 class="text-center title-2 col-5 offset-3"  >Profile</h3>
                </div>
                <strong class="text-primary">
                    <hr>
                </strong>
                @if (session('success'))
                    <div class="alert alert-info text-center alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="row">
                    <div class="col-10 offset-1">
                        <div class="row ">
                            <div class="col-4">
                                @if (!Auth::user()->image == null)
                                    <img class=" rounded-circle" style="height: 170px"
                                        src="{{ asset('storage/images/profile_images/'.Auth::user()->image) }}" alt="">
                                @else
                                    <img style="height: 200px; width:200px;"
                                        src="{{ asset('images/profile-images/default.png') }}" alt="John Doe" />
                                @endif
                            </div>
                            <div class="col-7 pl-4">
                                <h5 class="pt-1 text-capitalize"><i
                                        class="fa-solid fa-lg fa-file-signature text-success pr-3"></i>{{ Auth::user()->name }}
                                </h5>
                                <h5 class="pt-3 "><i
                                        class="fa-solid fa-lg fa-envelope text-success pr-3"></i>{{ Auth::user()->email }}
                                </h5>
                                <h5 class="pt-3 "><i class="fa-solid fa-lg fa-square-phone text-success pr-3"></i>
                                    {{ Auth::user()->phone }}</h5>
                                <h5 class="pt-3 "><i
                                        class="fa-solid fa-lg fa-map-location-dot text-success pr-3"></i>{{ Auth::user()->address }}
                                </h5>
                                <h5 class="pt-3 "><i
                                        class="fa-solid fa-lg fa-calendar-minus text-success pr-4"></i>{{ Auth::user()->created_at->format('j F Y') }}
                                </h5>
                            </div>
                        </div>
                        {{-- <div class="row  pb-3">
                            <div class="col-4 offset-8 ">
                                <a href="{{ route('profile#edit') }}" style="width: 100%" class="btn btn-primary">Edit
                                    Profile</a>
                            </div>
                        </div> --}}

                    </div>
                </div>
                <strong class="text-primary">
                    <hr>
                </strong>
            </div>
        </div>
    </div>
@endsection
