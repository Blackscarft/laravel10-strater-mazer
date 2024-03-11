@extends('layouts.auth')

@section('title', 'Login page')

@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

body{
    font-family: 'Poppins', sans-serif;
    background: #ececec;
}

/*------------ Login container ------------*/

.box-area{
    width: 930px;
}

/*------------ Right box ------------*/

.right-box{
    padding: 40px 30px 40px 40px;
}

/*------------ Custom Placeholder ------------*/

::placeholder{
    font-size: 16px;
}

.rounded-4{
    border-radius: 20px;
}
.rounded-5{
    border-radius: 30px;
}

.btn-login {
    --bs-btn-color: #fff;
    --bs-btn-bg: #5cd1c5;
    --bs-btn-border-color: #5cd1c5;
    --bs-btn-hover-color: #fff;
    --bs-btn-hover-bg: #4cafa5;
    --bs-btn-hover-border-color: #4cafa5;
}

/*------------ For small screens------------*/

@media only screen and (max-width: 768px){

    .box-area{
        margin: 0 10px;

    }
    .left-box{
        height: 100px;
        overflow: hidden;
    }
    .right-box{
        padding: 20px;
    }

}
</style>
@endpush

@section('main')
<!----------------------- Main Container -------------------------->
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <!----------------------- Login Container -------------------------->
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
    <!--------------------------- Left Box ----------------------------->
        <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #5cd1c5;">
            <div class="featured-image mb-3">
                <img src="{{ asset('static/images/login/login.png') }}" class="img-fluid" style="width: 250px;">
            </div>
            <p class="text-white fs-2" style="font-family: 'Poppins', Courier, monospace; font-weight: 600;">DigiQrify</p>
            <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Digital Qr Sign professional for your letters.</small>
        </div> 
    <!-------------------- ------ Right Box ---------------------------->
        
    <div class="col-md-6 right-box">
        <div class="row align-items-center">
                @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="header-text mb-4">
                    <h2>Hello,Again</h2>
                    <p>We are happy to have you back.</p>
                </div>
                <form method="post" action="{{ route('login') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="input-group mb-3">
                        <input 
                            type="email" 
                            name="email"
                            class="form-control form-control-lg bg-light fs-6" 
                            placeholder="Email address" 
                            style="border-radius: 7px;" 
                            value="{{ Cookie::get('email') !== null ? Cookie::get('email') : old('email') }}"
                            required
                        >
                        <div class="invalid-feedback">
                            Silahkan isi dengan format Email yang benar!
                        </div>
                    </div>
                    <div class="input-group mb-1">
                        <input 
                            name="password"
                            type="password" 
                            class="form-control form-control-lg bg-light fs-6" 
                            placeholder="Password" 
                            style="border-radius: 7px;" 
                            value="{{ Cookie::get('password') !== null ? Cookie::get('password') : old('password') }}"
                            required
                        >
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    </div>
                    <div class="input-group mb-5 d-flex justify-content-between">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="formCheck" name="remember" {{ Cookie::get('remember') !== null ? 'checked' : '' }}>
                            <label for="formCheck" class="form-check-label text-secondary"><small>Remember Me</small></label>
                        </div>
                        {{-- <div class="forgot">
                            <small><a href="#">Forgot Password?</a></small>
                        </div> --}}
                    </div>
                    <div class="input-group mb-3">
                        <button class="btn btn-lg btn-login w-100 fs-6" type="submit">Login</button>
                    </div>
                </form>
            </div>
        </div> 
    </div>
</div>
@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
    (() => {
        'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
        }

        form.classList.add('was-validated')
        }, false)
        })
    })()
</script>
@endpush