@extends('frontend.layouts.master')

@section('title','Majira|| Login Page')

@section('main-content')

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">Login</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
            
    <!-- Shop Login -->
    <section class="shop login section">
        <div class="container">
            <div class="row"> 
                <div class="col-lg-6 offset-lg-3 col-12">
                    <div class="login-form">
                            <h2>Login</h2>
                            <p>Please login to check your account</p>

                            <form id="ajaxLoginForm" class="form" method="post" novalidate>
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Your Email<span>*</span></label>
                                            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                                            <span class="text-danger error-email"></span>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Your Password<span>*</span></label>
                                            <input type="password" name="password" class="form-control" required>
                                            <span class="text-danger error-password"></span>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                         <div id="loginMessage" class="mt-2"></div>
                                         
                                         <div class="checkbox">
                                             <label><input type="checkbox" name="remember"> Remember me</label>
                                            </div>
                                            <div class="form-group login-btn">
                                                <button class="btn" type="submit">Login</button>
                                                <a href="{{ route('register.form') }}" class="btn">Register</a>
                                            </div>

                                        <!-- <a href="#" id="showForgotPasswordModal" class="lost-pass">
                                            Forgot your password?
                                        </a> -->

                                        <!-- Forgot Password Modal Div -->
                                        <!-- <div id="forgotPasswordModal" class="modal" tabindex="-1" role="dialog" style="display:none;">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Forgot Password</h5>
                                                        <button type="button" class="close" id="closeForgotPasswordModal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="forgotPasswordForm" method="POST">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="forgot_email">Email address</label>
                                                                <input type="email" class="form-control" id="forgot_email" name="email" required>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Send Reset Link</button>
                                                        </form>
                                                        <div id="forgotMessage" class="mt-2"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                        
                                        <style>
                                            /* Simple modal styling */
                                            #forgotPasswordModal.modal {
                                                position: fixed;
                                                z-index: 1050;
                                                left: 0;
                                                top: 0;
                                                width: 100vw;
                                                height: 100vh;
                                                overflow: auto;
                                                background: rgba(0,0,0,0.5);
                                                display: none;
                                            }
                                            #forgotPasswordModal .modal-dialog {
                                                margin: 10% auto;
                                                max-width: 400px;
                                            }
                                        </style>
                                    </div>
                                </div>
                            </form>

                           
                        </div>
                    <!--<div class="login-form">
                        <h2>Login</h2>
                        <p>Please register in order to checkout more quickly</p>
                         
                        <form class="form" method="post" action="{{route('login.submit')}}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Your Email<span>*</span></label>
                                        <input type="email" name="email" placeholder="" required="required" value="{{old('email')}}">
                                        @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Your Password<span>*</span></label>
                                        <input type="password" name="password" placeholder="" required="required" value="{{old('password')}}">
                                        @error('password')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group login-btn">
                                        <button class="btn" type="submit">Login</button>
                                        <a href="{{route('register.form')}}" class="btn">Register</a>
                                        
                                        <a href="{{route('login.redirect','facebook')}}" class="btn btn-facebook"><i class="ti-facebook"></i></a>
                                        <a href="{{route('login.redirect','github')}}" class="btn btn-github"><i class="ti-github"></i></a> -->
                                        <!-- <a href="{{route('login.redirect','google')}}" class="btn btn-google"><i class="ti-google"></i></a>  

                                    </div>
                                    <div class="checkbox">
                                        <label class="checkbox-inline" for="2"><input name="news" id="2" type="checkbox">Remember me</label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a class="lost-pass" href="{{ route('password.request') }}">
                                            Lost your password?
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>  
                        
                    </div> -->
                </div>
            </div>
        </div>
    </section>
    

    <!--/ End Login -->
@endsection
@push('styles')
<style>
    .shop.login .form .btn{
        margin-right:0;
    }
    .btn-facebook{
        background:#39579A;
    }
    .btn-facebook:hover{
        background:#073088 !important;
    }
    .btn-github{
        background:#444444;
        color:white;
    }
    .btn-github:hover{
        background:black !important;
    }
    .btn-google{
        background:#ea4335;
        color:white;
    }
    .btn-google:hover{
        background:rgb(243, 26, 26) !important;
    }
    
</style>
<style>
 
    </style>
@endpush

@push('scripts')
<script>
    $(document).ready(function(){

          $('#showForgotPasswordModal').on('click', function(e){
                e.preventDefault();
                $('#forgotPasswordModal').show();
            });
            $('#closeForgotPasswordModal').on('click', function(){
                $('#forgotPasswordModal').hide();
            });
            // Optional: Hide modal when clicking outside modal-content
            $('#forgotPasswordModal').on('click', function(e){
                if ($(e.target).is('#forgotPasswordModal')) {
                    $('#forgotPasswordModal').hide();
                }
            });

            
        $('#forgotPasswordForm').on('submit', function(e){
            e.preventDefault();
            $('#forgotMessage').html('<p class="text-info">Sending reset link...</p>');

            $.ajax({
                url: "{{ route('password.email') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response){
                    $('#forgotMessage').html('<p class="text-success">Reset link sent successfully! Please check your email.</p>');
                },
                error: function(xhr){
                    if(xhr.status === 422){
                        $('#forgotMessage').html('<p class="text-danger">'+xhr.responseJSON.message+'</p>');
                    } else {
                        $('#forgotMessage').html('<p class="text-danger">Unable to send reset link. Try again later.</p>');
                    }
                }
            });
        });

      $('#ajaxLoginForm').on('submit', function(e) {
    e.preventDefault();

    // Clear old errors
    $('.error-email').text('');
    $('.error-password').text('');
    $('#loginMessage').html('');

    $.ajax({
        url: "{{ route('login.submit') }}",
        method: "POST",
        data: $(this).serialize(),
        dataType: "json",
        beforeSend: function() {
            $('#ajaxLoginForm button[type="submit"]').attr('disabled', true).text('Please wait...');
        },
        complete: function() {
            $('#ajaxLoginForm button[type="submit"]').attr('disabled', false).text('Login');
        },
        success: function(response) {
            if (response.status === true) {
                $('#loginMessage').html('<div class="alert alert-success">' + response.message + '</div>');
                setTimeout(function() {
                    window.location.href = response.redirect_url;
                }, 1500);
            } else if (response.status === false) {
                $('#loginMessage').html('<div class="alert alert-danger">' + response.message + '</div>');
            }
        },
        error: function(xhr) {
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.errors;
                if (errors.email) {
                    $('.error-email').text(errors.email[0]);
                }
                if (errors.password) {
                    $('.error-password').text(errors.password[0]);
                }
            } else {
                $('#loginMessage').html('<div class="alert alert-danger">Something went wrong. Please try again later.</div>');
            }
        }
    });
});
    });
    </script>
@endpush