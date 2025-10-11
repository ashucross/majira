@extends('frontend.layouts.master')

@section('title','Majira|| Register Page')

@section('main-content')
<style>
.form-group {
  position: relative;
}

.toggle-password {
  position: absolute;
  top: 38px;
  right: 12px;
  cursor: pointer;
  color: #999;
  transition: color 0.3s ease;
}

.toggle-password:hover {
  color: #333;
}

    </style>

	<!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">Register</a></li>
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
                        <h2>Register</h2>
                        <p>Please register in order to checkout more quickly</p>
                        <!-- Form -->
                       

                        <form class="form" id="registerForm" method="post" action="{{ route('register.submit') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Your Name<span>*</span></label>
                                        <input type="text" name="name" placeholder="" required value="{{ old('name') }}">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Your Email<span>*</span></label>
                                        <input type="text" name="email" placeholder="" required value="{{ old('email') }}">
                                    </div>
                                </div>

                               <div class="col-12">
  <div class="form-group position-relative">
    <label>Your Password<span>*</span></label>
    <input type="password" name="password" class="form-control" id="password" placeholder="" required>
    <span class="toggle-password" toggle="#password">
      <i class="fa fa-eye"></i>
    </span>
  </div>
</div>

<div class="col-12">
  <div class="form-group position-relative">
    <label>Confirm Password<span>*</span></label>
    <input type="password" name="password_confirmation" class="form-control" id="confirm_password" placeholder="" required>
    <span class="toggle-password" toggle="#confirm_password">
      <i class="fa fa-eye"></i>
    </span>
  </div>
</div>


                                <div class="col-12">
                                    <div id="formErrors" class="mt-2"></div> <!-- Error area -->
                                    <div class="form-group login-btn">
                                        <button class="btn" type="submit">Register</button>
                                        <a href="{{ route('login.form') }}" class="btn">Login</a>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!--/ End Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Login -->
@endsection
@push('scripts')
<script>

$(document).ready(function() {

    $(document).on('click', '.toggle-password', function() {
    const input = $($(this).attr('toggle'));
    const icon = $(this).find('i');

    if (input.attr('type') === 'password') {
        input.attr('type', 'text');
        icon.removeClass('fa-eye').addClass('fa-eye-slash');
    } else {
        input.attr('type', 'password');
        icon.removeClass('fa-eye-slash').addClass('fa-eye');
    }
});


    $('#registerForm').on('submit', function(e) {
        e.preventDefault(); // prevent normal submit
        $('#formErrors').html(''); // clear old errors

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: $(this).serialize(),
            beforeSend: function() {
                $('.btn[type="submit"]').prop('disabled', true).text('Registering...');
            },
            success: function(response) {
                // On success, you can redirect or show success message
                $('#formErrors').html(
                    '<div class="alert alert-success">Successfully registered.</div>'
                );
                $('#registerForm')[0].reset();
                $('.btn[type="submit"]').prop('disabled', false).text('Register');
                setTimeout(() => {
                    window.location.href = '{{url("user/login")}}'; 
                }, 3000);
            },
            error: function(xhr) {
                $('.btn[type="submit"]').prop('disabled', false).text('Register');

                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorList = '<div class="alert alert-danger"><ul class="mb-0">';
                    $.each(errors, function(key, value) {
                        errorList += '<li>' + value[0] + '</li>';
                    });
                    errorList += '</ul></div>';
                    $('#formErrors').html(errorList);
                } else {
                    $('#formErrors').html(
                        '<div class="alert alert-danger">Something went wrong. Please try again.</div>'
                    );
                }
            }
        });
    });
});
</script>
@endpush
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
@endpush