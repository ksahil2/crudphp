<?php
include '../function.php';
$function = new functions();
$conn = mysqli_connect('localhost','root','Root@123','training_project');
$User = $function->select('users','user_types','classes');
// print_r($User);
if (!empty($_GET['delete'])) {
    if ($function->delete('users', ['id=' => $_GET['delete']])) {
        header('location:index.php');
    }
    echo 'Error in delete';
}

// $query = mysqli_query($conn,"SELECT u.*,ut.name,c.class_name from users u LEFT JOIN user_types ut ON u.user_type_id=ut.id LEFT JOIN classes c ON u.class_id =c.id");
// print_r($query);die;
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title>Users List</title>
    </head>
    <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mt-2">
      <a class="navbar-brand" href="create.php">Create User</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Users <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../user_types/create.php">User Types</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../classes/create.php">Classes</a>
          </li>
          </ul>
            <form class="form-inline my-2 my-lg-0">
              </div>
            </form>
        </div>
    </nav>

        <section class="container mt-3">
            <div class="card">
                <div class="card-header">
                    <a href="create.php"><button class="btn btn-info" type="button">Create</button></a>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-dark">
                        <thead class="thead-dark">
                            <tr>
                                <th>Name</th>
                                
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>User Name</th>
                                <th>Class Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($User as $Emp) { ?>
                                <tr>
                                    <td><?= $Emp['first_name'] . " " . $Emp['last_name']?></td>
                                    
                                    <td><?= $Emp['email'] ?></td>
                                    <td><?= $Emp['phone_number'] ?></td>
                                    
                                    <td><?php echo $Emp['name']; ?></td>
                                    <td><?= $Emp['class_name'] ?></td> 
                                    
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