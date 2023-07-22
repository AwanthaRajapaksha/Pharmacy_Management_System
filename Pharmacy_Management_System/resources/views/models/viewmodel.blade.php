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
                <div class="mb-1">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <div id="imageContainer1">

                            </div>
                          </div>
                          <div class="carousel-item">
                            <div id="imageContainer2">

                            </div>
                          </div>
                          <div class="carousel-item">
                            <div id="imageContainer3">

                            </div>
                          </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                        </button>
                      </div>




                    <label for="left" class="col-form-label fw-bold">Image :- </label>
                    <label for="right" class="col-form-label" id="Image"></label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                url: "/getprescription/"+prescription_id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#up_problem_id').val(data.prescription.id);

                    $('#Note').html(data.prescription.note);
                    $('#Address').html(data.prescription.address);
                    $('#token_number').html(data.prescription.prescription_token);
                    $('#Delivery_Date').html(data.prescription.delivery_date);
                    $('#Image').html(data.prescription.image1);
                    $('#Delivery_Time').html(data.prescription.delivery_time);


                    var $imageContainer1 = $('#imageContainer1');
                    $imageContainer1.empty();
                    var imageUrl = '{{ asset('storage/images/prescription_images') }}/'+data.prescription.image1;
                    var $img = $('<img>').attr('src', imageUrl).attr('alt', 'Image');
                    $imageContainer1.append($img);

                    var $imageContainer2 = $('#imageContainer2');
                    $imageContainer2.empty();
                    var imageUrl = '{{ asset('storage/images/prescription_images') }}/'+data.prescription.image1;
                    var $img = $('<img>').attr('src', imageUrl).attr('alt', 'Image');
                    $imageContainer2.append($img);

                    var $imageContainer3 = $('#imageContainer3');
                    $imageContainer3.empty();
                    var imageUrl = '{{ asset('storage/images/prescription_images') }}/'+data.prescription.image1;
                    var $img = $('<img>').attr('src', imageUrl).attr('alt', 'Image');
                    $imageContainer3.append($img);




                    if(data.prescription.note == ''){
                        $('#up_answer').html('The Ticket has not yet been reviewed');
                    }
                    else{
                        $('#up_answer').html(data.prescription.note);
                    }
                   // console.log(data.problem);
                },
                error: function() {
                    alert('Error loading data.');
                }
            });
        });
    </script>
