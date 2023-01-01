@extends('restaurants.partials.master')
@section('navbar')
@parent
@stop
@section('sidebar')
@parent
@stop
@section('page-title')
<div class="content-header-left col-md-4 col-12 mb-2">
    <h3 class="content-header-title">User Profile & Setting</h3>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <img class="rounded-circle img-fluid p-2" src="{{ asset('storage/avatar.png') }}" alt="Card image cap">
                    <div class="card-body">
                        <div id="UserDetail">
                            <h4 class="font-weight-bold text-center">{{ Auth::user()->first_name .' '. Auth::user()->last_name }}</h4>
                            <div class="text-center">
                                <span class="la la-map-marker"></span>
                                @if(Auth::user()->address != null)
                                <p class="font-weight-small">{{ Auth::user()->address }}</p>
                                @else
                                <small>Unset</small>
                                @endif
                            </div>
                        </div>
                        <form method="POST" id="FormUpdateProfile" class="hidden" action="{{ route('updateProfile', Auth::user()->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="FirstName">{{ __('First Name') }}</label>
                                <input name="first_name" id="FirstName" class="form-control" type="text" value="{{ Auth::user()->first_name }}">
                            </div>
                            <div class="form-group">
                                <label for="LastName">{{ __('Last Name') }}</label>
                                <input name="last_name" type="text" class="form-control" id="LastName" value="{{ Auth::user()->last_name }}">
                            </div>
                            <div class="form-group">
                                <label for="Address">{{ __('Address') }}</label>
                                <textarea name="address" type="text" class="form-control" id="Address">{{ Auth::user()->address }}</textarea>
                            </div>
                        </form>
                    </div>

                    <button id="open_edit_form" type="button" class="btn btn-secondary btn-min-width mx-1 mb-1 text-white">Edit Profile</button>
                    <button id="save_changes" type="submit" class="btn btn-primary btn-min-width mx-1 mb-1 hidden">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="phone_number">{{ __('Phone Number') }}</label>
                    </div>
                    <div class="col-md-6">
                        <input type="text" id="phone_number" value="{{ Auth::user()->phone_number }}" class="form-control" readonly>
                        @if(Auth::user()->is_phone_number_verified == 0)
                        <small class="font-italic mt-2 text-danger">Your phone number is not verified</small><br>
                        <button type="button" class="btn btn-success btn-sm mt-1 mb-1">Change Number</button>
                        <a href="#" class="btn btn-outline-primary btn-sm mt-1 mb-1">Verify Phone Number</a>
                        @else
                        <strong class="font-italic mt-2 text-success">Verified</strong><br>
                        <button type="button" class="btn btn-success btn-sm mt-1 mb-1">Change Number</button>
                        @endif
                    </div>
                </div>
                <form method="POST" action="#">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="email">{{ __('Email Address') }}</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="email" value="{{ Auth::user()->email }}" class="form-control" readonly>
                            @if(Auth::user()->email_verified_at == null)
                            <strong class="font-italic mt-2 text-danger">Your email address is not verified</strong><br>
                            <button type="button" class="btn btn-primary btn-sm mt-1 mb-1">Verify Now</button>
                            <button id="changeEmailButton" type="button" class="btn btn-success btn-sm mt-1 mb-1">Change Email Address</button>
                            <button id="okChangeEmail" type="button" class="btn btn-success btn-sm mt-1 mb-1 hidden">Change</button>
                            <button id="cancelChangeEmail" type="button" class="btn btn-light btn-sm mt-1 mb-1 hidden">Cancel</button>
                            @else
                            <strong class="font-italic mt-2 text-success">Verified</strong><br>
                            <button id="changeEmailButton" type="button" class="btn btn-success btn-sm mt-1 mb-1">Change Email Address</button>
                            <button id="okChangeEmail" type="button" class="btn btn-success btn-sm mt-1 mb-1 hidden">Change</button>
                            <button id="cancelChangeEmail" type="button" class="btn btn-light btn-sm mt-1 mb-1 hidden">Cancel</button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Update Password</h4>
                <form id="UpdatePassword" method="POST" action="{{ route('updatePassword', Auth::user()->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="current_password">{{ __('Current Password') }}</label>
                        </div>
                        <div class="col-md-6">
                            <input name="current_password" id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror">
                            @error('current_password')
                            <span class="invalid-feedback text-left" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="new_password">{{ __('New Password') }}</label>
                        </div>
                        <div class="col-md-6">
                            <input name="new_password" id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror">
                            @error('new_password')
                            <span class="invalid-feedback text-left" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="repeat_new_password">{{ __('Repeat New Password') }}</label>
                        </div>
                        <div class="col-md-6">
                            <input name="repeat_new_password" id="repeat_current_password" type="password" class="form-control @error('repeat_new_password') is-invalid @enderror">
                            @error('repeat_new_password')
                            <span class="invalid-feedback text-left" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <button id="UpdatePasswordButton" class="btn btn-primary btn-min-width my-1" type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var UserDetail = document.querySelector('#UserDetail');
        var FormUpdateProfile = document.querySelector('#FormUpdateProfile');
        var btnEditProfile = document.querySelector('#open_edit_form');
        var btnSaveProfile = document.querySelector('#save_changes');
        if (!btnEditProfile.hasAttribute('disabled')) {
            btnEditProfile.addEventListener('click', function() {
                UserDetail.classList.add('hidden');
                FormUpdateProfile.classList.remove('hidden');
                btnEditProfile.classList.add('disabled');
                btnSaveProfile.classList.remove('hidden');
            })
        }

        btnSaveProfile.addEventListener('click', function() {
            FormUpdateProfile.submit();
        })

        document.querySelector('#UpdatePasswordButton').addEventListener('click', function() {
            document.querySelector('#UpdatePassword').submit();
        })

        var changeEmailButton = document.querySelector('#changeEmailButton');
        var okChangeEmail = document.querySelector('#okChangeEmail');
        var cancelChangeEmail = document.querySelector('#cancelChangeEmail');

        changeEmailButton.addEventListener('click', function() {
            changeEmailButton.classList.add('hidden');
            okChangeEmail.classList.remove('hidden');
            cancelChangeEmail.classList.remove('hidden');
        });

        cancelChangeEmail.addEventListener('click', function() {
            cancelChangeEmail.classList.add('hidden');
            okChangeEmail.classList.add('hidden');
            changeEmailButton.classList.remove('hidden');
        })
    });
</script>
@endsection