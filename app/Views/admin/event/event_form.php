


<form id="add-admin-form" method="post" enctype="multipart/form-data" style="height:90vh;    overflow: scroll;">
    <h4 class="form-heading">Add New Event</h4>
    <div class="custom-tab-1">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#home1"><i class="la la-home me-2"></i> Personal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#profile1"><i class="la la-user me-2"></i> Profile</a>
            </li>


        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="home1" role="tabpanel">
            <input type="text" name="user_id" id="user_id" class="form-control d-none" required>
                <div class="pt-4 row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="first_name">Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" required>
                        </div>
                    </div>
                  
                    <div class="col-6">
                        <div class="form-group">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" name="meta_title" id="meta_title" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="meta_des">Meta Description</label>
                            <input type="text" name="meta_des" id="meta_des" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="date">Time</label>
                            <input type="text" name="time" id="time" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="meta_tag">Meta Tags</label>
                            <input type="text" name="meta_tag" id="meta_tag" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                   
                        <div class="form-group">
                            <label for="content">Content</label><br>
                            <div id="ckeditor" name="content"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="profile1">
                <?= $this->include('admin/event/profile_tab') ?>
            </div>


        </div>
        <div class="form-buttons mt-4">
            <button type="submit" id="form_sub" class="btn btn-primary btn-rounded">Add Admin</button>
            <button type="button" class="btn btn-secondary btn-rounded close-form">Cancel</button>
        </div>
    </div>
</form>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize CKEditor for the content field
    CKEDITOR.replace('ckeditor'); // Ensure the ID matches the editor's ID

    // Handle form submission
    $('#form_sub').click(function(e) {
        e.preventDefault(); // Prevent default button action

        var form = $('#add-admin-form');
        var url = 'view/save'; // Your endpoint to handle form submission

        // Create a FormData object to handle the form data
        var formData = new FormData(form[0]);

        // Get the content from CKEditor and add it to FormData
        var content = $('.ck-content').html();

        
        formData.append('content', content);

        // Check form data in console
        for (var pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }

        $.ajax({
            type: 'POST',
            url: url,
            data: formData, // Use FormData to handle multipart/form-data
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                form.find('button[type="submit"]').prop('disabled', true).text('Saving...');
            },
            success: function(response) {
                // Handle success response
                console.log('Response:', response);
                alert('Candidate data saved successfully!');
                location.reload();
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error('Error:', error);
                alert('Error saving candidate data. Please try again.');
            },
            complete: function() {
                form.find('button[type="submit"]').prop('disabled', false).text('Add Admin'); // Reset button state
            }
        });
    });
});
</script>





