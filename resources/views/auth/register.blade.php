@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;700&display=swap" rel="stylesheet">
<style>
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
        background: url('/images/background.jpg');
        background-size: cover;
        background-position: center;
    }

    .container {
        position: relative;
        width: 100%;
        max-width: 400px;
        height: auto;
        background: transparent;
        border-radius: 20px;
        border: 3px solid rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(30px);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        padding: 40px;
    }

    .main-box {
        width: 100%;
    }

    .main-box h1 {
        text-align: center;
        font-size: 35px;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 20px;
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

    .btn {
        width: 100%;
        height: 45px;
        background-color: #ffffff;
        border-radius: 30px;
        font-size: 15px;
        font-weight: 600;
        color: #020202;
        margin-top: 10px;
        cursor: pointer;
    }

    .login-link {
        text-align: center;
        color: #ffffff;
        font-size: 15px;
        font-weight: 500;
        margin-top: 25px;
    }

    .login-link a {
        font-weight: 600;
        color: #ffffff;
        text-decoration: none;
    }

    .login-link a:hover {
        text-decoration: underline;
    }
</style>

<div class="container">
    <div class="main-box">
        <h1>Register</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="input-box">
                <input id="name" type="text" name="name" required value="{{ old('name') }}">
                <label for="name">Name</label>
            </div>

            <div class="input-box">
                <input id="email" type="email" name="email" required value="{{ old('email') }}">
                <label for="email">Email</label>
            </div>

            <div class="input-box">
                <input id="password" type="password" name="password" required>
                <label for="password">Password</label>
            </div>

            <div class="input-box">
                <input id="password-confirm" type="password" name="password_confirmation" required>
                <label for="password-confirm">Confirm Password</label>
            </div>

            <button type="submit" class="btn">Register</button>

            <div class="login-link">
                <p>Already have an account?
                    <a href="{{ route('login') }}">Login</a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection
