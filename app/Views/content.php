<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>S7T Exam - STOCK</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .toolbar {
            float: left;
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/5.0/examples/sign-in/signin.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>
<body data-new-gr-c-s-check-loaded="9.59.0" data-gr-ext-installed="">
<div class="container">
    <div class="row">
        <?php if ($action === 'LIST') { ?>
            <div class="col-12">
            <table class="table table-bordered table-striped table-responsive" id="employeeDatatable">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First name</th>
                    <th scope="col">Last name</th>
                    <th scope="col">Position</th>
                    <th scope="col">Created At</th>
                    <th scope="col">ACTIONS</th>
                </tr>
                </thead>
                <tbody>
                <?php if (count($employees) > 0) { ?>
                    <?php foreach ($employees as $index => $employee) { ?>
                        <tr>
                            <th scope="row"><?= ($index + 1) ?></th>
                            <td><?= $employee['first_name'] ?></td>
                            <td><?= $employee['last_name'] ?></td>
                            <td><?= $employee['position'] ?></td>
                            <td><?= $employee['created_at'] ?></td>
                            <td>
                                <form action="<?= site_url('/employees/delete/' . $employee['id']) ?>" method="post" class="p-0 m-0">
                                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <a href="/employees/<?= $employee['id'] ?>" class="btn btn-sm btn-primary m-0">Show</a>
                                    <a href="/employees/edit/<?= $employee['id'] ?>" class="btn btn-sm btn-warning m-0">Edit</a>
                                    <button type="submit" class="btn btn-sm btn-danger m-0">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="6" class="text-center">NO RECORD FOUND</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-center">
                            <a href="/employees/create" class="btn btn-sm btn-success m-0">Create</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <?php } else { ?>
            <form action="<?php if ($action === 'CREATE') { echo site_url('/employees/store'); } else { echo site_url('/employees/update'); } ?>" method="post">
                <input type="hidden" name="id" value="<?php echo $employee['id']; ?>">
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <div class="col-4 offset-4">
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First name</label>
                        <input type="text" class="form-control form-control-sm" id="firstName" name="first_name" <?php if ($action === 'SHOW') { ?> disabled="disabled" <?php } ?> <?php if ($action === 'SHOW' || $action === 'EDIT') { ?> value="<?= $employee['first_name'] ?>" <?php } ?>>
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last name</label>
                        <input type="text" class="form-control form-control-sm" id="lastName" name="last_name" <?php if ($action === 'SHOW') { ?> disabled="disabled" <?php } ?> <?php if ($action === 'SHOW' || $action === 'EDIT') { ?> value="<?= $employee['last_name'] ?>" <?php } ?>>
                    </div>
                    <div class="mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" class="form-control form-control-sm" id="position" name="position" <?php if ($action === 'SHOW') { ?> disabled="disabled" <?php } ?> <?php if ($action === 'SHOW' || $action === 'EDIT') { ?> value="<?= $employee['position'] ?>" <?php } ?>>
                    </div>
                    <div class="mb-3 float-right">
                        <?php if ($action === 'CREATE') { ?>
                            <button type="submit" class="btn btn-sm btn-success">Create</button>
                        <?php } ?>
                        <?php if ($action === 'EDIT') { ?>
                            <button type="submit" class="btn btn-sm btn-warning">Update</button>
                        <?php } ?>
                        <a href="/" class="btn btn-sm btn-light m-0 float-end">Cancel</a>
                    </div>
                </div>
            </form>
        <?php } ?>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $('#employeeDatatable').DataTable({
            lengthChange: false,
            dom: '<"toolbar">frtip',
        });

        $('div.toolbar').html('<a href="/employees/create" class="btn btn-sm btn-success m-0">Create</a>');
    });
</script>
</body>
</html>