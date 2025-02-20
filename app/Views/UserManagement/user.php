<?= $this->extend('layouts/base') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><?= $title ?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('/dashboard') ?>">Home</a></li>
                    <li class="breadcrumb-item active"><?= $title ?></li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
                <i class="fa fa-plus-circle"></i> Add User
            </button>
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Sr.No.</th>
                        <th>Name</th>
                        <th>User Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $serialNumber = 1; ?>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $serialNumber++ ?></td>
                        <td><?= $user['username'] ?></td>
                        <td><?= $user['usertype'] ?></td>
                        <td>
                            <button class="btn btn-info btn-sm"
                                onclick="getUserDetails('<?= base64_encode($user['userid']) ?>')"><i
                                    class="fa fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            Footer
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
<!-- Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addUserForm" method="post" action="<?= site_url('/adduser') ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="username">Profile Image</label>
                        <input type="file" class="form-control" id="profile" name="profile" required>
                    </div>
                    <div class="form-group">
                        <label for="userType">User Type</label>
                        <select class="form-control" id="userType" name="userType" required>
                            <?php foreach ($usertypes as $usertype): ?>
                                <option value="<?= $usertype['usertypeid'] ?>"><?= $usertype['usertype'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Add other form fields as needed -->
                </form>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById('showPassword').addEventListener('click', function() {
    var passwordField = document.getElementById('password');
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        this.innerHTML = '<i class="fa fa-eye-slash"></i>';
    } else {
        passwordField.type = 'password';
        this.innerHTML = '<i class="fa fa-eye"></i>';
    }
});

function getUserDetails(userId) {
    $.ajax({
        url: '<?= site_url('/getuser') ?>/' + userId,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                $('#firstname').val(response.data.firstname);
                $('#middlename').val(response.data.middlename);
                $('#lastname').val(response.data.lastname);
                $('#userType').val(response.data.userType).trigger('change');
                $('#username').val(response.data.username);
                $('#isactive').prop('checked', response.data.isactive);
                $('#addUserModal').modal('show');
            } else {
                alert('Failed to fetch user details.');
            }
        },
        error: function() {
            alert('Error in fetching user details.');
        }
    });
}
</script>
<?= $this->endSection() ?>