<?php

try {
  include "../Validation.php";

  $validation = new Validation();
  if (!empty($_POST)) {
    $error = $validation->classValidation($_POST);
    // print_r($error);
    // print_r(count($error));
    if (empty($error)) {
      $column = 'class_name';
      $value = '("' . $_REQUEST['class_name'] . '")';

      $function = new functions();
      if ($function->insert('classes', $column, $value)) {
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Create Class</title>
</head>

<body>
    <section class="container mt-3">
        <form action="" method="post">
            <div class="card">
                <div class="card-header"> <a href="index.php"><button class="btn btn-info"
                            type="button">View</button></a></div>
                <div class="card-body">
                    <div class="form-group row">

                        <label for="class_name">Class Name :</label>
                        <input type="text" placeholder="Enter Class Name" class="form-control" name="class_name"
                            id="class_name"
                            value="<?php echo isset($_POST['class_name']) ?  $_POST['class_name'] : ""; ?>">
                        <p><small
                                style="color:red"><?= isset($error['class_name']) ? $error['class_name'] : "" ?></small>
                        </p>
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