<?= $this->include('admin/common/header') ?>
<?= $this->include('admin/common/menu') ?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Manage Rewords</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-none">
                <button type="button" class="btn btn-rounded btn-primary open-add-form">
                    <span class="btn-icon-left text-primary">
                        <i class="fa fa-plus"></i>
                    </span>Add New
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">List of Rewords</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example4" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>S No</th>
                                        <th>Name</th>
                                        <th>Points</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($reword as $index => $city): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= $city->name ?></td>
                                            <td><?= $city->points ?></td>
                                            
                                            <td>
                                                <button type="button" class="btn btn-rounded btn-warning open-update-form" data-id="<?= $city->id ?>">Update</button>
                                                
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="basicModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Are you sure you want to delete this city?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger confirm-delete">Confirm</button>
            </div>
        </div>
    </div>
</div>

<!-- Overlay -->
<div class="overlay"></div>

<!-- Add New City Form -->


<!-- Update City Form -->
<div class="right-sidebar" id="updateCityForm">
    <div class="sliding-form">
        <form id="update-city-form" method="post">
            <h4 class="form-heading">Update Reword</h4>
            <div class="form-group">
                <label for="city_name">Name</label>
                <input type="text" name="name" id="update-name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="name">Points</label>
                <input type="text" name="points" id="update-points" class="form-control" required>
            </div>
            
            <div class="form-buttons">
                <button type="submit" class="btn btn-primary btn-rounded">Update City</button>
                <button type="button" class="btn btn-secondary btn-rounded close-form">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Success</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Operation completed successfully.</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
    .right-sidebar {
        position: fixed;
        top: 0;
        right: -400px;
        width: 400px;
        height: 100%;
        background: #fff;
        box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
        transition: right 0.3s;
        z-index: 1000;
    }
    .right-sidebar.show {
        right: 0;
    }
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        z-index: 999;
    }
    .overlay.show {
        display: block;
    }
    .sliding-form {
        padding: 20px;
    }
    .form-heading {
        background: #395cff;
        color: #fff;
        text-align: center;
        margin: 0 -20px 20px;
        padding: 10px 20px;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }
    .form-buttons .btn {
        width: 48%;
    }
</style>

<script>
    $(document).ready(function() {
      

        $('.open-update-form').click(function() {
            var cityId = $(this).data('id');
            $.get(`<?= base_url('admin/settings/editRewords') ?>/${cityId}`, function(data) {
               
               console.log(data);
               
                $('#update-name').val(data.name);
                $('#update-points').val(data.points);
                $('#update-city-form').attr('action', `<?= base_url('admin/settings/updateRewords') ?>/${cityId}`);
                $('#updateCityForm').addClass('show');
                $('.overlay').addClass('show');
            });
        });

        $('.close-form, .overlay').click(function() {
            $('.right-sidebar').removeClass('show');
            $('.overlay').removeClass('show');
        });

        $('#add-city-form').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var url = '<?= base_url('admin/settings/storeCity') ?>';
            $.ajax({
                type: 'POST',
                url: url,
                data: form.serialize(),
                beforeSend: function() {
                    form.find('button[type="submit"]').prop('disabled', true).text('Saving...');
                },
                success: function(response) {
                    $('#confirmationModal').modal('show');
                    form.find('button[type="submit"]').prop('disabled', false).text('Add City');
                    form.closest('.right-sidebar').removeClass('show');
                    $('.overlay').removeClass('show');
                    location.reload();
                }
            });
        });

        $('#update-city-form').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            $.ajax({
                type: 'POST',
                url: url,
                data: form.serialize(),
                beforeSend: function() {
                    form.find('button[type="submit"]').prop('disabled', true).text('Updating...');
                },
                success: function(response) {
                    $('#confirmationModal').modal('show');
                    form.find('button[type="submit"]').prop('disabled', false).text('Update City');
                    form.closest('.right-sidebar').removeClass('show');
                    $('.overlay').removeClass('show');
                    location.reload();
                }
            });
        });

        $('.delete-city').click(function() {
            var cityId = $(this).data('id');
            $('.confirm-delete').attr('data-id', cityId);
        });

        $('.confirm-delete').click(function() {
            var cityId = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: `<?= base_url('admin/settings/deleteCity/') ?>/${cityId}`,
                success: function(response) {
                    $('#confirmationModal').modal('show');
                    location.reload();
                }
            });
        });
    });
</script>

<?= $this->include('admin/common/footer') ?>

