<div class="modal" tabindex="-1" aria-hidden="true" id="viewShowQuotations">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Quotation Details :-  </h5>
                <label  for="recipient-name" class="col-form-label mt-1"  id="Quotation_token_number"> </label>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-1">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col">
                                <section>
                                    <table id="quotationTable"  style="width:100%">
                                        <thead>
                                            <tr>
                                            <th id="" >Drug</th>
                                            <th id="">Quantity</th>
                                            <th id="">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                            <tr style="border-top: 1px solid rgb(71, 68, 68);">
                                                <td colspan="2" style="text-align: right;"><strong>Total:</strong></td>
                                                <td id="totalAmountCell"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <button type="button" id="RejectQuotations" class="btn btn-danger RejectQuotations "  style="float: right; margin-top:10px;">Reject</button>
                                    <button type="button" id="AcceptQuotations" class="btn btn-info  AcceptQuotations" style="float: right;margin-top:10px;margin-right:10px;">Accept</button>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
        $(document).on('click','.ShowQuotations',function(e){
            e.preventDefault();
            var prescription_id =localStorage.getItem('prescriptionid');
            var user_type =localStorage.getItem('user_type');
            //console.log(user_type);
            $('#viewmodel').modal('hide');
            $('#viewShowQuotations').modal('show');
            $.ajax({
                url: "/get_quotations_details/"+prescription_id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {

                    $('#quotationTable tbody').empty();
                    $('#prescriptionTable tbody').empty();

                    if (user_type == 'Admin') {
                        $('#RejectQuotations').hide();
                        $('#AcceptQuotations').hide();
                    } else {
                        $('#RejectQuotations').show();
                        $('#AcceptQuotations').show();
                    }
                    //console.log(data.quotation.tableData);
                    //console.log(typeof data.quotation.tableData);

                    $token_number = localStorage.getItem('prescription_token');


                    $('#quotationTable tbody').empty();
                    let row;

                    for (let item of data.quotation.tableData) {
                         row = '<tr>' +
                            '<td>' + item.name + '</td>' +
                            '<td>' + item.quantity + '</td>' +
                            '<td>' + item.total + '</td>' +
                            '</tr>';
                        $('#quotationTable tbody').append(row);
                    }
                    $('#prescriptionTable tbody').append(row);
                    $('#Quotation_token_number').html($token_number);
                    // Append the total of all items to the total cell in the table footer
                    $('#totalAmountCell').text(data.quotation.totalAmount);
                },
                error: function() {
                    alert('Error loading data.');
                }
            });
        });
    </script>

    <script>
        $(document).on('click','.AcceptQuotations',function(e){
            e.preventDefault();
            var prescription_id =localStorage.getItem('prescriptionid');
            var states ='Accept';
            var userId = localStorage.getItem('userid');
            var prescription_token =localStorage.getItem('prescription_token');
            //console.log(prescription_id);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                url: "/Get_Quatation_Type",
                type: 'POST',
                data: {
                    prescription_id: prescription_id,
                    states: states,
                    userId:userId,
                    prescription_token:prescription_token,// Include the totalAmount in the data
                },
                dataType: 'json',
                success: function(data) {
                    window.location.reload();
                    //console.log(data);

                },
                error: function(error) {
                    console.log('Error occurred:', error);
                }
            });
        });
    </script>

    <script>
        $(document).on('click','.RejectQuotations',function(e){
            e.preventDefault();
            var prescription_id =localStorage.getItem('prescriptionid');
            var states ='Reject';
            var userId = localStorage.getItem('userid');
            var prescription_token =localStorage.getItem('prescription_token');
            //console.log(prescription_id);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                url: "/Get_Quatation_Type",
                type: 'POST',
                data: {
                    prescription_id: prescription_id,
                    states: states,
                    userId:userId,
                    prescription_token:prescription_token,// Include the totalAmount in the data
                },
                dataType: 'json',
                success: function(data) {
                    window.location.reload();
                    //console.log(data);

                },
                error: function(error) {
                    console.log('Error occurred:', error);
                }
            });
        });
    </script>
