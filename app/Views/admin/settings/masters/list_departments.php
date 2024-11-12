<?= $this->include('admin/common/header') ?>
<?= $this->include('admin/common/menu') ?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Manage Departments</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <button type="button" class="btn btn-rounded btn-primary open-add-department-form">
                    <span class="btn-icon-left text-primary">
                        <i class="fa fa-plus"></i>
                    </span>Add New Department
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">List of Departments</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example4" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($departments as $department): ?>
                                        <tr>
                                            <td><?= $department['id'] ?></td>
                                            <td><?= $department['name'] ?></td>
                                            <td><?= $department['created_at'] ?></td>
                                            <td><?= $department['updated_at'] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-rounded btn-warning open-edit-department-form" data-id="<?= $department['id'] ?>">Edit</button>
                                                <button type="button" class="btn btn-rounded btn-danger delete-department" data-id="<?= $department['id'] ?>" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
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

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Are you sure you want to delete this department?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger confirm-delete" data-id="">Confirm</button>
            </div>
        </div>
    </div>
</div>

<div class="overlay"></div>

<!-- Add/Edit Department Form -->
<div class="right-sidebar " id="addEditDepartmentForm">
    <div class="sliding-form">
        <form id="department-form" action="<?= base_url('admin/masters/departments/edit/') ?>" method="post">
            <h4 class="form-heading" id="formTitle">Add New Department</h4>
            <div class="form-group">
                <label for="name">Department Name</label>
                <input type="text" name="name" id="departmentName" class="form-control" required>
            </div>
            <div class="form-buttons">
                <button type="submit" class="btn btn-primary btn-rounded">Save</button>
                <button type="button" class="btn btn-secondary btn-rounded close-form">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
    $('.open-add-department-form').click(function() {
    $('#formTitle').text('Add New Department');
    $('#departmentName').val('');  // Clear any previous input
    $('#department-form').attr('action', '<?= base_url('admin/settings/storeDepartment') ?>');
    $('#addEditDepartmentForm').addClass('show');
    $('.overlay').addClass('show');
});


        $('.open-edit-department-form').click(function() {
            var deptId = $(this).data('id');
            $.get(`<?= base_url('admin/settings/editDepartment/') ?>/${deptId}`, function(data) {
                
                $('#departmentName').val(data.department.name);
                $('#department-form').attr('action', `<?= base_url('admin/settings/updateDepartment') ?>/${deptId}`);
                $('#formTitle').text('Edit Department');
                $('#addEditDepartmentForm').addClass('show');
                $('.overlay').addClass('show');
            });
        });

        $('.close-form, .overlay').click(function() {
            $('.right-sidebar').removeClass('show');
            $('.overlay').removeClass('show');
        });

        $('.delete-department').click(function() {
            var deptId = $(this).data('id');
            $('.confirm-delete').attr('data-id', deptId);
        });

        $('.confirm-delete').click(function() {
            var deptId = $(this).data('id');
            
            $.ajax({
                type: 'POST',
                url: `<?= base_url('admin/settings/deleteDepartment') ?>/${deptId}`,
                success: function(response) {
                    location.reload();
                }
            });
        });

        $('#department-form').submit(function(e) {
            e.preventDefault();  // Prevent the default form submission
            var form = $(this);
            var url =  $('#department-form').attr('action');
            $.ajax({
                type: 'POST',
                url: url,
                data: form.serialize(),
                beforeSend: function() {
                    form.find('button[type="submit"]').prop('disabled', true).text('Saving...');
                }, 
                success: function(response) {
                    // Handle response here
                    alert('Department added successfully!');
                    $('#addEditDepartmentForm').removeClass('show');
                    $('.overlay').removeClass('show');
                    // Optionally reload the departments list or append the new department
                    location.reload();  // Reload to see the new list; consider dynamic update for better UX
                },
                error: function() {
                    alert('Error adding department. Please try again.');
                }
            });
         });

    });
</script>

<?= $this->include('admin/common/footer') ?>
