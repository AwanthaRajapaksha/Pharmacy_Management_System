@extends('layouts.app')

@section('content')

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <img src="https://img.freepik.com/free-vector/medicine-information-poster-with-medication-pharmacy-symbols-realistic-illustration_1284-36588.jpg?w=996&t=st=1690194376~exp=1690194976~hmac=7c7f1d6270a085b778bd442cceed0f493c0bac5d6d69a86e7db46aa5cb5fe20a
    "
    alt="Logo" width="100%" style="margin-top:-50px;">

    @include('models.postmodel')

    @include('models.viewmodel')

    @include('models.quotationmodel')

    @include('models.showquotationmodel')


@endsection
