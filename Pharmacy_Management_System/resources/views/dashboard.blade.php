@extends('layouts.app')

@section('content')
<div class="container">

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    @include('validation.validation')
    <div>
        <h1 style="text-align: center;" >Prescription Details</h1>
    </div>
    <div class="row">
        <div class="col">
            <section>
                <table id="userTable">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Prescription Token</th>
                            <th>Delivery Date</th>
                            <th>Time Slot</th>
                            <th>States</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $adminCounter = 0;
                            $userCounter = 0;
                        @endphp

                        @foreach ($Prescriptions as $key => $Prescription)
                            @if ($Prescription->user_type == 'Admin')
                                @php $adminCounter++; @endphp
                                <tr class="status">
                                    <td>{{ $adminCounter }}</td>
                                    <td>{{ $Prescription->prescription_token }}</td>
                                    <td>{{ $Prescription->delivery_date }}</td>
                                    <td>{{ $Prescription->delivery_time }}</td>
                                    <td>{{ $Prescription->states }}</td>
                                    <td>
                                        <button type="button" class="PrescriptionDetails btn btn-success" value="{{ $Prescription->id }}">View</button>
                                    </td>
                                </tr>
                            @elseif ($Prescription->user_id == Auth::user()->id)
                                @php $userCounter++; @endphp
                                <tr class="status">
                                    <td>{{ $userCounter }}</td>
                                    <td>{{ $Prescription->prescription_token }}</td>
                                    <td>{{ $Prescription->delivery_date }}</td>
                                    <td>{{ $Prescription->delivery_time }}</td>
                                    <td>{{ $Prescription->states }}</td>
                                    <td>
                                        <button type="button" class="PrescriptionDetails btn btn-success" value="{{ $Prescription->id }}">View</button>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </section>
        </div>
    </div>

    @include('models.postmodel')

    @include('models.viewmodel')

    @include('models.quotationmodel')

    @include('models.showquotationmodel')

</div>

@endsection
