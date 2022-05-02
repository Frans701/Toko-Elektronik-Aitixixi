@extends('layouts.template')
@section('content')
    <!-- di bawah menu baru kontennya -->
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col col-lg-4 col-md-4">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img src="{{ asset('img/avatar4.png') }}" alt="profil" class="profile-user-img img-responsive img-circle-elevation-2">
                        </div>
                        <h3 class="profile-username text-center">{{ Auth::user()->user_name }}</h3>
                        <p class="text-muted text-center">Terverifikasi pada {{ Auth::user()->email_verified_at }}</p>
                        <hr>
                        <strong>
                            <i class="fas fa-envelope mr-2"></i>
                            Email
                        </strong>
                        <p class="text-muted">
                            {{ Auth::user()->email }}
                        </p>
                        <hr>
                        <strong>
                            <i class="fas fa-map-marker mr-2"></i>
                            Alamat
                        </strong>
                        <p class="text-muted">
                            {{ Auth::user()->alamat }}
                        </p>
                        <hr>
                        <strong>
                            <i class="fas fa-phone mr-2"></i>
                            Telepon
                        </strong>
                        <p class="text-muted">
                            {{ Auth::user()->telepon }}
                        </p>
                    </div>
                </div>      
            </div>
        </div>
    </div>
@endsection