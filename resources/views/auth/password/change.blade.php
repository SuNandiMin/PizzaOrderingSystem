@extends('layouts.admin.master')

@section('content')
    <div class="col-lg-6 offset-3 mt-5">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2">Change Password</h3>
                </div>
                <hr>
                <form action="{{ route('change#password') }}" method="post" novalidate="novalidate">
                    @csrf
                    <div class="row form-group d-flex justify-content-around">
                        @if (session('not-match'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><p class="text-danger"><i class="fa-solid fa-triangle-exclamation text-danger"></i>
                                {{ session('not-match') }}</p></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="col-3 text-center pt-2">
                            <label for="oldPassword" class="control-label mb-1">OldPassword</label>
                        </div>
                        <div class="col-8 position-relative">
                            <input id="oldPassword" name="oldPassword" type="password" class="form-control"
                                aria-required="true" aria-invalid="false" placeholder="Enter old password . . .">
                            @error('oldPassword')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group d-flex justify-content-around">
                        <div class="col-3 text-center p-2">
                            <label for="cc-payment" class="control-label mb-1">NewPassword</label>
                        </div>
                        <div class="col-8 position-relative">
                            <div class="col-11 text-end"><i class="icon fa-solid fa-eye position-absolute p-3"
                                    id="togglePassword" style="cursor: pointer"></i></div>
                            <input id="id_password" name="newPassword" type="password" class="form-control"
                                aria-required="true" aria-invalid="false" placeholder="Enter new password . . .">

                            @error('newPassword')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group d-flex justify-content-around">
                        <div class="col-3 text-center p-2">
                            <label for="cc-payment" class="control-label mb-1">ConfirmPassword</label>
                        </div>
                        <div class="col-8 position-relative">
                            <input id="cc-payment" name="confirmPassword" type="password" class="form-control"
                                aria-required="true" aria-invalid="false" placeholder="Confirm Your New password . . .">
                        </div>
                    </div>
                    <div class="d-flex justify-content-around text-center">
                        <div class="col-3">
                            <a href="{{ URL::previous() }}" class="">
                                <button type="button" class="btn btn-lg btn-danger btn-block">
                                    Cancle <i class="fa-regular fa-circle-xmark fa-lg"></i>
                                </button>
                            </a>
                        </div>
                        <div class="col-7">
                            <button id="payment-button" type="submit" class="btn btn-lg btn-success btn-block">
                                <span id="payment-button-amount">Change Password</span>
                                <span id="payment-button-sending" style="display:none;">Sending…</span>
                                <i class="fa-regular fa-square-check"></i>
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#id_password');

        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>
@endsection
