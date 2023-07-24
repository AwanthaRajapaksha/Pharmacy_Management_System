<div class="modal" tabindex="-1" aria-hidden="true" id="quotationmodel">
    <div class="modal-dialog" style="width:700px;">
    <div class="modal-content" >
        <div class="modal-header">
            <h5 class="modal-title">Send Quotation</h5> :-  </h5>
            <label  for="recipient-name" class="col-form-label mt-1"  id="token_number"> </label>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6">
                    <div class="mb-1" style="width: 100%;">
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner" id="imageCarousel2">
                                <!-- Images will be appended here -->
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col">
                            <section>
                                <table id="QuotationTable"  style="width:100%">
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
                                            <td id="totalCell"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </section>
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col">
                            <div class="form-group row">
                                <label for="fname" class="col-sm-4 col-form-label">Drug:</label>
                                <div class="col-sm-8">
                                    <select id="drugSelect" name="drugSelect" class="form-control"></select>
                                </div>
                            </div>

                            <div class="form-group row pt-1">
                                <label for="lname" class="col-sm-4 col-form-label">Quantity:</label>
                                <div class="col-sm-8">
                                    <input type="text" id="quantity" name="quantity" class="form-control" >
                                </div>
                            </div>

                            <div class="form-group row pt-1">
                                <div class="col-sm-12 text-right">
                                    <input type="submit" value="Add" class="btn btn-primary adddrug"  style="float: right; ">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        <div class="modal-footer">
            <button id="Quotations" class="btn btn-primary SendQuotations">Send Quotations</button>
        </div>
        </div>
    </div>
    </div>
</div>
     <script>
        $(document).ready(function() {
            // Function to fetch drug names and populate the select element
            function populateDrugSelect() {
                $.ajax({
                    url: '/Get_Drugs_Names', // Replace with the actual URL to fetch drug names from the server
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {

                        var selectElement = $('#drugSelect');
                        selectElement.empty(); // Clear the previous options

                        // Loop through the drug names and append options to the select element
                        $.each(data.drugs, function(index, drug) {
                            selectElement.append('<option value="' + drug.id + '">' + drug.name + '</option>');
                        });
                    },
                    error: function(error) {
                        console.log('Error occurred:', error);
                    }
                });
            }

            // Call the function to populate the drug select when the page loads
            populateDrugSelect();
        });

     </script>

    <script>
        $(document).on('click','.Quotations',function(e){
            $('#viewmodel').modal('hide');
            $('#quotationmodel').modal('show');
            $('#QuotationTable').hide();
            var prescription_id =localStorage.getItem('prescriptionid');
            //console.log(prescription_id);

            $.ajax({
                url: "/Get_Prescription/"+prescription_id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {

                    $('#quotationTable tbody').empty();

                    var $imageCarousel2 = $('#imageCarousel2');
                    $imageCarousel2.empty();

                    for (let i = 1; i <= 5; i++) {
                        if (data.prescription['image' + i]) {
                            var imageUrl = '{{ asset('storage/images/prescription_images') }}/' + data.prescription['image' + i];
                            var $img = $('<img>').attr('src', imageUrl).attr('alt', 'Image').css({
                                'width': '100%',
                                'height': '200px',
                                'border': '1px solid black',
                                'border-radius': '5px',
                                'margin': '10px'
                            });
                            var $carouselItem = $('<div>').addClass('carousel-item');
                            if (i === 1) {
                                $carouselItem.addClass('active');
                            }
                            $carouselItem.append($img);
                            $imageCarousel2.append($carouselItem);
                        }
                    }
                },
                error: function() {
                    alert('Error loading data.');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var totalAmount = 0;
            $(document).on('click', '.adddrug', function(e) {
                var drug_id = $('#drugSelect').val();
                $('#QuotationTable').show();
                $.ajax({
                    url: "/Getdrug_Details/" + drug_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var quantity = $('#quantity').val();
                        var price = data.drug.price;
                        var total = quantity * price;
                        totalAmount += total; // Add the total of the current drug to the running total

                        var formattedTotal = parseFloat(total).toFixed(2);
                        var formattedTotalAmount = parseFloat(totalAmount).toFixed(2);

                        var row = '<tr>' +
                            '<td>' + data.drug.name + '</td>' +
                            '<td>' + price + ' * ' + quantity + '</td>' +
                            '<td>' + formattedTotal + '</td>' +
                            '</tr>';
                        $('#QuotationTable tbody').append(row);

                        // Append the total of all items to the total cell in the table footer
                        $('#totalCell').text(formattedTotalAmount);
                    },
                    error: function(error) {
                        console.log('Error occurred:', error);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).on('click','.SendQuotations',function(e){

            e.preventDefault();

            var tableData = [];

            // Loop through the table rows and gather data
            $('#QuotationTable tbody tr').each(function() {
                var rowData = {
                    name: $(this).find('td:eq(0)').text(),
                    quantity: $(this).find('td:eq(1)').text(),
                    total: $(this).find('td:eq(2)').text()
                    // Add other data as needed
                };

                tableData.push(rowData);
            });

            var totalAmount = parseFloat($('#totalCell').text());
            var user_id =localStorage.getItem('userid');
            var prescription_token =localStorage.getItem('prescription_token');
            var prescription_id =localStorage.getItem('prescriptionid');

            //console.log(totalAmount);
            console.log(tableData);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                url: "/Send_Email",
                type: 'POST',
                data: {
                    tableData: tableData,
                    totalAmount: totalAmount,
                    userid: user_id,
                    prescription_token:prescription_token,
                    prescription_id:prescription_id,// Include the totalAmount in the data
                },
                dataType: 'json',
                success: function(data) {
                    window.location.reload();
                    console.log(data);

                },
                error: function(error) {
                    console.log('Error occurred:', error);
                }
            });

        });
    </script>
