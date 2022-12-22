@extends('mg-sanctum::layouts.emails.default', [
    'title' => 'Panera Mg'
])

@push('css')
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <style type="text/css">
        body {
            text-align: center;
            margin: 0 auto;
            width: 650px;
            font-family: 'Rubik', sans-serif;
            background-color: #e2e2e2;
            display: block;
        }

        .mb-3 {
            margin-bottom: 30px;
        }

        ul {
            margin: 0;
            padding: 0;
        }

        li {
            display: inline-block;
            text-decoration: unset;
        }

        a {
            text-decoration: none;
        }

        h5 {
            margin: 10px;
            color: #777;
        }

        .text-center {
            text-align: center
        }

        .welcome-name h5 {
            font-weight: normal;
            margin: 10px 0 0;
            color: #232323;
            text-align: justify;
            line-height: 1.6;
            letter-spacing: 0.05em;
        }

        .welcome-details p span {
            color: #00639e;
            font-weight: 700;
            margin: 0 2px;
            text-decoration: underline;
        }

        .welcome-details p {
            font-weight: normal;
            font-size: 14px;
            color: #232323;
            line-height: 1.6;
            letter-spacing: 0.05em;
            margin: 0;
            text-align: justify;
        }

        .verify-button a {
            padding: 12px 30px;
            border: none;
            background-color: #00639e;
            color: #fff;
            font-weight: 500;
            font-size: 15px;
            letter-spacing: 1.3px;
            border-radius: 5px;
        }

        .how-work li {
            margin: 0 20px;
            color: #232323;
            position: relative;
        }

        .how-work li:after {
            content: '';
            position: absolute;
            top: 50%;
            left: -21px;
            width: 2px;
            height: 70%;
            background-color: #7e7e7e;
            transform: translateY(-50%);
        }

        .how-work li:first-child::after {
            content: none;
        }

        .main-bg-light {
            background-color: #fafafa;
        }
    </style>
@endpush

@section('logo')
    <img src="{{ asset('assets/images/Logos/panera.svg') }}" alt="Logo paneraMg">
@endsection

@section('greeting')
    Hi {{ $user->name  }} and welcome to PaneraMg!
@endsection

@section('main-content')
    <h5>
        We hope our product will lead you, like many other before you, to a place where your ideas where
        your ideas can spark and grow, a place where you'll find all your inspiration needs.
    </h5>
    <h5>Before we get started, we'll need to verify your email.</h5>
@endsection

@section('verification-button')
    <a href="{{$user->generateVerificationLink()}}">Verify Email</a>
@endsection

@section('additional-content')
    <p>
        If you have any question, please email us at <span>contact@panera.mg</span> or mgcodeur our
        <span>FAQs.</span> You can also chat with a real live human during our operating hours. They can
        answer questions about your account or help you with your meditation practice.
    </p>
@endsection
