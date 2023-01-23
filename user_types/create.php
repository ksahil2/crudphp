<?php

try {
  include "../Validation.php";

    $validation = new Validation();
    if (!empty($_POST)) {
      $error = $validation->typeValidation($_POST);
      print_r($error);
      // print_r(count($error));
      if (empty($error)) {
        $column = 'name';
        $value = '("' . $_REQUEST['name'] . '")';

        $function = new functions();
        if ($function->insert('user_types', $column, $value)) {
          header('location:index.php');
        }
      }
    }
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

  <title>User Types</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mt-2">
    <a class="navbar-brand" href="#">User Types</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
      <li class="nav-item">
            <a class="nav-link" href="../user/create.php">User</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../classes/create.php">Classes</a>
          </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <div class="dropdown show">
          <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Dropdown
          </a>

          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="index.php">Index</a>

          </div>
        </div>
      </form>
    </div>
  </nav>

  <section class="container mt-3">


    <form action="" method="post">
      <div class="card mt-3">
        <div class="card-header"> <a href="index.php"><button class="btn btn-info" type="button">View</button></a></div>
        <div class="card-body">
          <div class="form-group row">

            <label for="name">Name :</label>
            <input type="text" placeholder="Enter Name" class="form-control" name="name" id="name" value="<?php echo isset($_POST['name']) ?  $_POST['name'] : ""; ?>">
            <p><small style="color:red"><?= isset($error['name']) ? $error['name'] : "" ?></small></p>
          </div>

        </div>

      </div>
      <div class="card-footer">
        <button type="submit" id="submit" name="submit" type="submit" class="btn btn-success">Save</button>
      </div>
    </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    </form>
  </section>
</body>

</html>