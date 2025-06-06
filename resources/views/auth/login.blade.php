@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;700&display=swap" rel="stylesheet">
<style>
    /* Paste your CSS here */
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;700&display=swap");
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        border: none;
        outline: none;
        text-decoration: none;
        font-family: "Poppins", sans-serif;
    }

    body {
        height: 100vh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: url('/images/background.jpg'); /* Ubah path sesuai kebutuhan */
        background-size: cover;
        background-position: center;
    }

    .container {
        position: relative;
        width: 100%;
        max-width: 400px;
        height: 500px;
        background: transparent;
        border-radius: 20px;
        border: 3px solid rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(30px);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .main-box {
        padding: 50px;
        width: 100%;
    }

    .main-box h1 {
        text-align: center;
        font-size: 40px;
        font-weight: 700;
        color: #ffffff;
    }

    .input-box {
        position: relative;
        height: 55px;
        width: 100%;
        border-bottom: 2px solid #ffffff;
        margin: 32px 0;
    }

    .input-box label {
        position: absolute;
        top: 50%;
        left: 6px;
        transform: translateY(-50%);
        pointer-events: none;
        color: #ffffff;
        font-weight: 500;
        font-size: 17px;
        transition: all ease 0.4s;
    }

    .input-box input {
        height: 100%;
        width: 100%;
        background-color: transparent;
        font-size: 15px;
        font-weight: 600;
        color: #ffffff;
        padding: 0 30px 0 6px;
    }

    .input-box input:focus ~ label,
    .input-box input:valid ~ label {
        top: -3px;
    }

    .check {
        color: #ffffff;
        font-size: 15px;
        font-weight: 500;
        margin: -10px 0 15px;
        display: flex;
        justify-content: space-between;
    }

    .check label input {
        vertical-align: middle;
        margin-right: 6px;
        accent-color: #ffffff;
    }

    .check a {
        color: #ffffff;
    }

    .check a:hover {
        text-decoration: underline;
    }

    .btn {
        width: 100px;
        height: 45px;
        background-color: #ffffff;
        border-radius: 30px;
        font-size: 15px;
        font-weight: 600;
        color: #020202;
        margin-top: 10px;
        cursor: pointer;
    }

    .register {
        text-align: center;
        color: #ffffff;
        font-size: 15px;
        font-weight: 500;
        margin: 35px 0 10px;
    }

    .register p a {
        font-size: 15px;
        font-weight: 600;
        color: #ffffff;
        margin-left: 5px;
    }

    .register p a:hover {
        text-decoration: underline;
    }
</style>

<div class="container ">
    <div class="main-box">
        <h1>Login</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-box">
                <input id="email" type="email" name="email" required value="{{ old('email') }}">
                <label for="email">Email</label>
            </div>

            <div class="input-box">
                <input id="password" type="password" name="password" required>
                <label for="password">Password</label>
            </div>

            <div class="check">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    Remember Me
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Forgot Password?</a>
                @endif
            </div>

            <button type="submit" class="btn">Login</button>

            <div class="register">
                <p>Don't have an account?
                    <a href="{{ route('register') }}">Register</a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection
