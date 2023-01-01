@extends('admin.partials.master')
@section('navbar')
@parent
@stop
@section('sidebar')
@parent
@stop
@section('content')
<div id="user-profile">
    <div class="row">
        <div class="col-sm-12 col-xl-8">
            <div class="m-1 media d-flex ">
                <div class="p-1 align-left">
                    <a href="#" class="profile-image">
                        <img src="{{ asset('images/profile.svg') }}" class="rounded-circle img-border height-100" alt="Card image">
                    </a>
                </div>
                <div class="mt-1 text-left media-body">
                    <h3 class="font-large-1 white">{{ $user->name }}
                        <span class="font-medium-1 white">({{ $user->roles->first()->name }})</span>
                    </h3>
                    <p class="white">
                        <i class="ft-map-pin white"> </i> {{ $user->email }} </p>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-md-4">
            <div class="pt-2 text-center card card-info">
                <div class="card-block">
                    <h3 class="font-weight-bold h3 text-danger">Jual Beli</h3>
                    <i class="la la-institution" style="font-size: 64px;"></i>
                </div>
                <div class="rounded row no-gutters">
                    <div class="rounded col-12">
                        <div class="card card-block text-info rounded-0 border-left-0 border-right-0 border-top-0 border-bottom-0">
                            <h3>{{ count($jualbeli) }}</h3>
                            <span class="text-uppercase">items</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="pt-2 text-center card card-info">
                <div class="card-block">
                    <h3 class="font-weight-bold h3 text-danger">Perseroan Terbatas</h3>
                    <i class="la la-building" style="font-size: 64px;"></i>
                </div>
                <div class="rounded row no-gutters">
                    <div class="rounded col-12">
                        <div class="card card-block text-info rounded-0 border-left-0 border-right-0 border-top-0 border-bottom-0">
                            <h3>{{ count($terbatas) }}</h3>
                            <span class="text-uppercase">items</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="pt-2 text-center card card-info">
                <div class="card-block">
                    <h3 class="font-weight-bold h3 text-danger">Perseroan Komanditer</h3>
                    <i class="la la-building-o" style="font-size: 64px;"></i>
                </div>
                <div class="rounded row no-gutters">
                    <div class="rounded col-12">
                        <div class="card card-block text-info rounded-0 border-left-0 border-right-0 border-top-0 border-bottom-0">
                            <h3>{{ count($komanditer) }}</h3>
                            <span class="text-uppercase">items</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <!--Project Timeline div starts-->
            <!-- <div id="timeline">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title-wrap bar-primary">
                            <div class="card-title">Change Password</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-block">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="CurrentPassword">Current Password</label>
                                    <input type="text" name="password" id="" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="NewPassword">New Password</label>
                                    <input type="text" name="newpassword" id="" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="ConfirmNewPassword">Confirm New Password</label>
                                    <input type="text" name="confirmnewpassword" id="" class="form-control">
                                </div>
                                <input class="btn btn-primary" type="button" value="Update Password">
                            </form>
                        </div>
                    </div>
                </div>
            </div> -->
            <!--Project Timeline div ends-->
        </div>
    </div>
</div>
@endsection