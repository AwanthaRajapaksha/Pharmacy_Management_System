@extends('layouts.app')

@section('content')
<div class="container">

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <div>
        <h1 style="text-align: center;" >Prescription Details</h1>
    </div>
    <div class="row">
        <div class="col">
            <section>
                <table id="userTable" >
                <thead>
                    <tr>
                    <th id="" >Item</th>
                    <th id="">Prescription Token</th>
                    <th id="">Delivery Date</th>
                    <th id="">Time Slot</th>
                    <th id="">States</th>
                    <th id="">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Prescriptions as $key => $Prescription)
                        @if ($Prescription->user_type == 'Admin')
                            @include('auth.user.admin')
                        @else
                            @include('auth.user.user')
                        @endif
                    @endforeach
                </tbody>
                </table>
            </section>
        </div>
    </div>


    @include('models.postmodel')

    @include('models.viewmodel')

</div>

@endsection
