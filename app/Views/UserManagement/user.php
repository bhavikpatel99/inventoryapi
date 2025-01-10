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
            <!-- Modal -->
            <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="addUserForm" method="post" action="<?= base_url('/adduser') ?>" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="username">Profile Image</label>
                                    <input type="file" class="form-control" id="profile" name="profile" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" required>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Middle Name">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="userType">User Type</label>
                                    <select class="form-control select2" id="userType" name="userType" required style="width: 100%;">
                                        <option value="">--Please Select--</option>
                                        <?php foreach ($usertypes as $usertype): ?>
                                            <option value="<?= $usertype['userTypeId'] ?>"><?= $usertype['userType'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="User Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="showPassword"><i class="fa fa-eye"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-check">
                                    <input id="isactive" class="form-check-input" type="checkbox" name="isactive" value="true">
                                    <label for="isactive" class="form-check-label">Is Active?</label>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" form="addUserForm">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
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
                        <td><?= $serialNumber++ ?></td>
                        <td><?= $user['userName'] ?></td>
                        <td><?= $user['userType'] ?></td>
                        <td>
                            <button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
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
</script>
<?= $this->endSection() ?>

