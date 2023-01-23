<?php

try {
  include "../Validation.php";
  
  $validation = new Validation();
  if (!empty($_POST)) {
    $error = $validation->userValidation($_POST);
    if (empty($error)) {
      $column = 'first_name,last_name,email,phone_number,password,user_type_id,class_id';
      $value = '("' . $_REQUEST['first_name'] . '","' . $_REQUEST['last_name'] . '","' . $_REQUEST['email'] . '","' . $_REQUEST['phone_number'] . '","' . $_REQUEST['password'] . '","' . $_REQUEST['user_type_id'] . '","' . $_REQUEST['class_id'] . '")';
      $email = $_POST['email'];
      $function = new functions();
      if ($function->insert('users', $column, $value)) {
        header('location:index.php');
      }
    }
  } 
  $function = new functions();
  $userTypes = $function->select('user_types');
  // print_r($userTypes);
  $classId = $function->select('classes');
  // print_r($classId);

} catch (Exception $ex) {
  print_r($ex->getMessage());
}

?>
<!doctype html>
<html lang="en">


<script>
$(document).ready(function() {
    $("#first_name").click(function() {
        $("p").hide();
    });
});
</script>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Create User</title>
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
        <form action="" method="post">
            <div class="card">
                <div class="card-header"> <a href="index.php"><button class="btn btn-info"
                            type="button">View</button></a></div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="first_name">First Name :</label>
                        <div class="col-sm-10 mb-4">
                            <input type="text" class="form-control" name="first_name" id="first_name"
                                value="<?php echo isset($_POST['first_name']) ?  $_POST['first_name'] : ""; ?>">
                            <p><small
                                    style="color:red"><?= isset($error['first_name']) ? $error['first_name'] : "" ?></small>
                            </p>
                        </div>
                        <label class="col-sm-2 col-form-label" for="last_name">Last Name :</label>
                        <div class="col-sm-10 mb-4">
                            <input type="text" class="form-control" name="last_name" id="last_name"
                                value="<?php echo $_REQUEST['last_name'] ?>">
                            <small
                                style="color:red"><?= !empty($error['last_name']) ? $error['last_name'] : "" ?></small>
                        </div>

                        <label class="col-sm-2 col-form-label" for="email">Email :</label>
                        <div class="col-sm-10 mb-4">
                            <input type="text" class="form-control" name="email" id="email"
                                value="<?php echo $_REQUEST['email'] ?>">
                            <small style="color:red"><?= !empty($error['email']) ? $error['email'] : "" ?> </small>
                        </div>

                        <label class="col-sm-2 col-form-label" for="phone_number">Phone Number :</label>
                        <div class="col-sm-10 mb-4">
                            <input type="text" class="form-control" name="phone_number" id="phone_number"
                                value="<?php echo $_REQUEST['phone_number'] ?>">
                            <small style="color:red"><?= !empty($error['phone']) ? $error['phone'] : "" ?></small>
                        </div>

                        <label class="col-sm-2 col-form-label" for="select">User Type :</label>
                        <div class="col-sm-10 mb-4">

                            <select class="custom-select" name="user_type_id">
                                <option value="">Select</option>
                                <?php foreach($userTypes as $userType){ ?>
                                <option value="<?= $userType['id'] ?>"> <?= $userType['name'] ?> </option>
                                <?php } ?>
                            </select>
                            <small
                                style="color:red"><?= !empty($error['user_type_id']) ? $error['user_type_id'] : "" ?></small>
                        </div>

                        <label class="col-sm-2 col-form-label" for="select">Class :</label>
                        <div class="col-sm-10 mb-4">

                            <select class="custom-select" name="class_id">
                                <option value="">Select</option>
                                <?php foreach($classId as $classid){ ?>
                                <option value="<?= $classid['id'] ?>"> <?= $classid['class_name'] ?> </option>
                                <?php } ?>
                            </select>
                            <small
                                style="color:red"><?= !empty($error['class_id']) ? $error['class_id'] : "" ?></small>
                        </div>

                        <label class="col-sm-2 col-form-label" for="password">Password :</label>
                        <div class="col-sm-10 mb-4">
                            <input type="password" class="form-control" name="password" id="password"
                                value="<?php echo $_REQUEST['password'] ?>">
                            <small style="color:red"><?= !empty($error['password']) ? $error['password'] : "" ?></small>

                        </div>

                        <label class="col-sm-2 col-form-label" for="cpassword">Confirm Password :</label>
                        <div class="col-sm-10 mb-4">
                            <input type="password" class="form-control" name="cpassword" id="cpassword" value="">
                            <small
                                style="color:red"><?= !empty($error['cpassword']) ? $error['cpassword'] : "" ?></small>

                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" id="submit" name="submit" type="submit" class="btn btn-success">Save</button>
                </div>
        </form>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        </form>
    </section>
</body>

</html>