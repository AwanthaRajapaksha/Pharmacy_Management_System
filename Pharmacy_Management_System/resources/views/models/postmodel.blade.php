    <div class="modal" tabindex="-1" aria-hidden="true" id="PostModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Post Your Prescription</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('prescriptions.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (Auth::check() && Auth::user()->id)
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        @else
                            <input type="hidden" name="user_id" value="default_value">
                        @endif
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Prescription Images (Max 5):</label>
                            <input type="file" name="images[]" class="form-control" accept="image/*" multiple id="imageInput" required>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Delivery Address:</label>
                            <textarea class="form-control" name="address"  required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Delivery Date:</label>
                            <input type="date" name="delivery_date" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Delivery Time:</label>
                            <select name="delivery_time" id="delivery_time"  class="form-control">
                                <option value="05.00 AM - 07.00 AM">05.00 AM - 07.00 AM</option>
                                <option value="07.00 AM - 09.00 AM">07.00 AM - 09.00 AM</option>
                                <option value="09.00 AM - 11.00 AM">09.00 AM - 11.00 AM</option>
                                <option value="11.00 AM - 01.00 PM">11.00 AM - 01.00 PM</option>
                                <option value="01.00 PM - 03.00 PM">01.00 PM - 03.00 PM</option>
                                <option value="03.00 PM - 05.00 PM">03.00 PM - 05.00 PM</option>
                                <option value="05.00 PM - 07.00 PM">05.00 PM - 07.00 PM</option>
                              </select>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Note:</label>
                            <textarea class="form-control" name="note"  required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Upload Prescription</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <script>
        $(document).on('click','.PostPrescription',function(e){
            $('#PostModal').modal('show');
        });
    </script>

    <script>
        // Add an event listener to the file input element
        document.getElementById('imageInput').addEventListener('change', function() {
            var files = this.files;
            var maxFiles = 5;

            // Check the number of selected files
            if (files.length > maxFiles) {
                alert('You can only select up to ' + maxFiles + ' images.');
                // Clear the selected files to prevent submitting more than 5 images
                this.value = null;
            }
        });
    </script>
