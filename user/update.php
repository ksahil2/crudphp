<?php
try {
    if (!isset($_GET['id'])) {
        header('location:index.php');
    }
    include "../Validation.php";
    $function = new functions();
    // print_r('1');
    if (!empty($_POST)) {
        $validationObj = new Validation();
        $error = $validationObj->userValidation($_POST, $_GET['id']);
        
        if (empty($error)) {
            if ($function->update('users', $_POST, ['id = ' => $_GET['id']])) {
                header('location:index.php');
            }
        }
    }
    $user  = $function->select("users", ["id = " => $_GET['id']],1);
    // print_r($user);

    $function = new functions();
    $userTypes = $function->select('user_types');

    $classId = $function->select('classes');


} catch (Exception $ex) {
    print_r($ex->getMessage());
    }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>First Name:<?php echo $user['first_name'] ?></title>
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

    <section class="container mt-4">
        <form action="" method="POST">
            <div class="card">
                <div class="card-header"> <a href="index.php"><button class="btn btn-info" type="button">View</button></a></div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="first_name">First Name :</label>
                        <div class="col-sm-10 mb-4">
                            <input type="text" class="form-control" value="<?php echo $user['first_name'] ?>" name="first_name" id="first_name">
                            <small style="color:red"><?= !empty($error['first_name']) ? $error['first_name'] : "" ?></small>
                        </div>

                        <label class="col-sm-2 col-form-label" for="last_name">Last Name :</label>
                        <div class="col-sm-10 mb-4">
                            <input type="text" class="form-control" value="<?php echo $user['last_name'] ?>" name="last_name" id="last_name">
                            <small style="color:red"><?= !empty($error['last_name']) ? $error['last_name'] : "" ?></small>
                        </div>

                        <label class="col-sm-2 col-form-label" for="email">Email :</label>
                        <div class="col-sm-10 mb-4">
                            <input type="text" class="form-control" value="<?php echo $user['email'] ?>" name="email" id="email">
                            <small style="color:red"><?= !empty($error['email']) ? $error['email'] : "" ?></small>
                        </div>

                        <label class="col-sm-2 col-form-label" for="phone_number">Phone Number :</label>
                        <div class="col-sm-10 mb-4">
                            <input type="text" class="form-control" value="<?php echo $user['phone_number'] ?>" name="phone_number" id="phone_number">
                            <small style="color:red"><?= !empty($error['phone']) ? $error['phone'] : "" ?></small>
                        </div>
                        <label class="col-sm-2 col-form-label" for="select">User Type :</label>
                            <div class="col-sm-10 mb-4">
                                <select class="custom-select" name="user_type_id" value="<?=$user['user_type_id']?>">
                                    <option  value="">Select</option>
                                    <?php foreach($userTypes as $userType){ ?>
                                        <option value="<?= $userType['id'] ?>" <?=($userType['id'] == $user['user_type_id']?'selected':"") ?>  ?><?= $userType['name']?> </option>
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
                                    <option value="<?= $classid['id'] ?>" <?= ($classid['id'] == $user['class_id']?'selected':"")?> >  <?= $classid['class_name'] ?>  </option>
                                    <?php } ?>
                                </select>
                                <small
                                    style="color:red"><?= !empty($error['class_id']) ? $error['class_id'] : "" ?></small>
                            </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" id="update" class="btn btn-success">Update</button>
                </div>
        </form>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        </form>
    </section>
</body>

</html>