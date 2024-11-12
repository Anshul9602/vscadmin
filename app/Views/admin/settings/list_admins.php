<?= $this->include('admin/common/header') ?>
<?= $this->include('admin/common/menu') ?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Manage Dashboard Users</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
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
                        <h4 class="card-title">List of Admins</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example4" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>S No</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($admins as $index => $admin): ?>
                                        <tr>
                                            <td><?= $index + 1 ?></td>
                                            <td><?= $admin['email'] ?></td>
                                            <td><?= $admin['role'] ?></td>
                                            <td><?= $admin['created_at'] ?></td>
                                            <td><span class="badge light badge-success">Active</span></td>
                                            <td>
                                                <button type="button" class="btn btn-rounded btn-warning open-update-form" data-id="<?= $admin['id'] ?>">Update</button>
                                                <?php if ($index != 0): ?>
                                                    <button type="button" class="btn btn-rounded btn-danger delete-admin" data-id="<?= $admin['id'] ?>" data-bs-toggle="modal" data-bs-target="#basicModal">Delete</button>
                                                <?php endif; ?>
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
            <div class="modal-body">Are you sure you want to delete this admin?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger confirm-delete">Confirm</button>
            </div>
        </div>
    </div>
</div>

<!-- Overlay -->
<div class="overlay"></div>

<!-- Add New Admin Form -->
<div class="right-sidebar" id="addAdminForm">
    <div class="sliding-form">
        <form id="add-admin-form" method="post">
            <h4 class="form-heading">Add New Admin</h4>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <input type="password" name="password" class="form-control" required>
                    <button type="button" class="btn btn-outline-secondary toggle-password"><i class="fa fa-eye"></i></button>
                </div>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <div class="input-group">
                    <input type="password" name="confirm_password" class="form-control" required>
                    <button type="button" class="btn btn-outline-secondary toggle-password"><i class="fa fa-eye"></i></button>
                </div>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <input type="text" name="role" class="form-control" value="admin" readonly>
            </div>
            <div class="form-buttons">
                <button type="submit" class="btn btn-primary btn-rounded">Add Admin</button>
                <button type="button" class="btn btn-secondary btn-rounded close-form">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- Update Admin Form -->
<div class="right-sidebar" id="updateAdminForm">
    <div class="sliding-form">
        <form id="update-admin-form" method="post">
            <h4 class="form-heading">Update Admin</h4>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="update-email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password (Leave blank if not changing)</label>
                <div class="input-group">
                    <input type="password" name="password" class="form-control">
                    <button type="button" class="btn btn-outline-secondary toggle-password"><i class="fa fa-eye"></i></button>
                </div>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <input type="text" name="role" id="update-role" class="form-control" value="admin" readonly>
            </div>
            <div class="form-buttons">
                <button type="submit" class="btn btn-primary btn-rounded">Update Admin</button>
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



<script>
    $(document).ready(function() {
        $('.open-add-form').click(function() {
            $('#addAdminForm').addClass('show');
            $('.overlay').addClass('show');
        });

        $('.open-update-form').click(function() {
            var adminId = $(this).data('id');
            $.get(`<?= base_url('admin/settings/editAdmin/') ?>/${adminId}`, function(data) {
                $('#update-email').val(data.email);
                $('#update-role').val(data.role);
                $('#update-admin-form').attr('action', `<?= base_url('admin/settings/updateAdmin/') ?>/${adminId}`);
                $('#updateAdminForm').addClass('show');
                $('.overlay').addClass('show');
            });
        });

        $('.close-form, .overlay').click(function() {
            $('.right-sidebar').removeClass('show');
            $('.overlay').removeClass('show');
        });

        $('.toggle-password').click(function() {
            var input = $(this).prev('input');
            var icon = $(this).find('i');
            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                input.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });

        $('#add-admin-form').submit(function(e) {
            e.preventDefault();
            if ($('input[name="password"]').val() !== $('input[name="confirm_password"]').val()) {
                alert('Passwords do not match');
                return;
            }
            var form = $(this);
            var url = '<?= base_url('admin/settings/storeAdmin') ?>';
            $.ajax({
                type: 'POST',
                url: url,
                data: form.serialize(),
                beforeSend: function() {
                    form.find('button[type="submit"]').prop('disabled', true).text('Saving...');
                },
                success: function(response) {
                    $('#confirmationModal').modal('show');
                    form.find('button[type="submit"]').prop('disabled', false).text('Add Admin');
                    form.closest('.right-sidebar').removeClass('show');
                    $('.overlay').removeClass('show');
                    location.reload();
                }
            });
        });

        $('#update-admin-form').submit(function(e) {
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
                    form.find('button[type="submit"]').prop('disabled', false).text('Update Admin');
                    form.closest('.right-sidebar').removeClass('show');
                    $('.overlay').removeClass('show');
                    location.reload();
                }
            });
        });

        $('.delete-admin').click(function() {
            var adminId = $(this).data('id');
            $('.confirm-delete').attr('data-id', adminId);
        });

        $('.confirm-delete').click(function() {
            var adminId = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: `<?= base_url('admin/settings/deleteAdmin/') ?>/${adminId}`,
                success: function(response) {
                    $('#confirmationModal').modal('show');
                    location.reload();
                }
            });
        });
    });
</script>

<?= $this->include('admin/common/footer') ?>
