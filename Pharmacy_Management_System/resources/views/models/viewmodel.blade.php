    <div class="modal" tabindex="-1" aria-hidden="true" id="viewmodel">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Prescription Details :-  </h5>
                <label  for="recipient-name" class="col-form-label mt-1"  id="token_number"> </label>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-1">
                    <label for="left" class="col-form-label fw-bold">Delivery Date :- </label>
                    <label  for="right" class="col-form-label"  id="Delivery_Date"></label>
                </div>
                <div class="mb-1">
                    <label for="left" class="col-form-label fw-bold">Delivery Time :- </label>
                    <label  for="right" class="col-form-label"  id="Delivery_Time"></label>
                </div>
                <div class="mb-1">
                    <label for="left" class="col-form-label fw-bold">Note :- </label>
                    <label for="right" class="col-form-label" id="Note"></label>
                </div>
                <div class="mb-1">
                    <label for="left" class="col-form-label fw-bold">Address :- </label>
                    <label for="right" class="col-form-label" id="Address"></label>
                </div>
                <div class="mb-1" style="width: 100%;">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner" id="imageCarousel">
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
            <div class="modal-footer">
                <button id="Quotations" class="btn btn-primary Quotations">Prepare Quotations</button>
                <button id="ShowQuotations" class="btn btn-primary ShowQuotations">Show Quotations Details</button>
            </div>
            </div>
        </div>
        </div>
    </div>

    <script>
        $(document).on('click','.PrescriptionDetails',function(e){
            e.preventDefault();
            var prescription_id =$(this).val();
            //console.log(prescription_id);
            $('#viewmodel').modal('show');
            $.ajax({
                url: "/Get_Prescription/"+prescription_id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {

                    localStorage.setItem("prescriptionid", data.prescription.id);
                    localStorage.setItem("userid", data.prescription.user_id);
                    localStorage.setItem("prescription_token", data.prescription.prescription_token);
                    localStorage.setItem("user_type", data.user_type);

                    $('#Note').html(data.prescription.note);
                    $('#Address').html(data.prescription.address);
                    $('#token_number').html(data.prescription.prescription_token);
                    $('#Delivery_Date').html(data.prescription.delivery_date);
                    $('#Delivery_Time').html(data.prescription.delivery_time);

                    //console.log(data.prescription.states);

                    if (data.user_type == 'Admin') {
                        $('#Quotations').show();
                    } else {
                        $('#Quotations').hide();
                      }

                    if (data.prescription.states == 'Not Yet Send Quotations') {
                      $('#ShowQuotations').hide();
                    } else {
                      $('#ShowQuotations').show();
                    }
                    if (data.prescription.states == 'Accept' || data.prescription.states == 'Reject' || data.prescription.states == 'Under review') {
                        $('#Quotations').hide();
                      } else {
                        $('#ShowQuotations').hide();
                      }

                      $('#quotationTable tbody').empty();

                      // Process the images
                    var $imageCarousel = $('#imageCarousel');
                    $imageCarousel.empty();

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
                            $imageCarousel.append($carouselItem);
                        }
                    }
                },
                error: function() {
                    alert('Error loading data.');
                }
            });
        });
    </script>
