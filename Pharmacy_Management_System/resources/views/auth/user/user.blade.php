@if ($Prescription->user_id == Auth::user()->id)
    <tr class="status">
        <td id="">{{ $key+1 }}</td>
        <td id="">{{ $Prescription->prescription_token }}</td>
        <td id="">{{ $Prescription->delivery_date }}</td>
        <td id="">{{ $Prescription->delivery_time }}</td>
        <td id="">{{ $Prescription->states }}</td>
        <td id="">
        <button type="button"  class="PrescriptionDetails btn btn-success "  value="{{ $Prescription->id }}" >View</button>
        </td>
    </tr>
@endif



