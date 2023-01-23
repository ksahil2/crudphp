<?php
try {
    if (!isset($_GET['id'])) {
        header('location:index.php');
    }
    include "../Validation.php";
    $function = new functions();
    if (!empty($_POST)) {
        $validationObj = new Validation();
        $error = $validationObj->typeValidation($_POST,$_GET['id']);
        // print_r($error);die;
        if (empty($error)) {
            if ($function->update('user_types', $_POST, ['id = ' => $_GET['id']])) {
                header('location:index.php');
            }
        }
    }
    $class  = $function->select("user_types", ["id = " => $_GET['id']], 1);
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

    <title><?php echo $class['name'] ?></title>
</head>

<body>
    <section class="container mt-4">
        <form action="" method="POST">
            <div class="card">
                <div class="card-header"> <a href="index.php"><button class="btn btn-info" type="button">View</button></a></div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name">Name :</label>
                        <div class="col-sm-10 mb-4">
                            <input type="text" class="form-control" value="<?php echo $class['name'] ?>" name="name" id="name">
                            <small style="color:red"><?= !empty($error['name']) ? $error['name'] : "" ?></small>
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