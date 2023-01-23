<?php
include '../function.php';
$function = new functions();
$Class = $function->select('classes');
if (!empty($_GET['delete'])) {
    if ($function->delete('classes', ['id=' => $_GET['delete']])) {
        header('location:index.php');
    }
    echo 'Error in delete';
}

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title>Classes</title>
    </head>
    <body>
        <section class="container mt-3">
            <div class="card">
                <div class="card-header">
                    <a href="create.php"><button class="btn btn-info" type="button">Create</button></a>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-LIGHT">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Class Name</th>
                                <th>Created on</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($Class as $Emp) { ?>
                                <tr>
                                    <td><?= $Emp['id'] ?></td>
                                    <td><?= $Emp['class_name'] ?></td>
                                    <td><?= $Emp['created'] ?></td>
                                    <td>
                                        <a href="update.php?id=<?php echo $Emp['id'] ?>" class="btn btn-success">Edit</a>
                                        <a onclick="return confirm('Are you Sure?')" href="?delete=<?= $Emp['id'] ?>" class="btn btn-danger" id="del">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    </body>
</html>