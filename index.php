<?php
$insert = false;
$notinsert = false;
//Connection with data base
$server_name = "localhost";
$username = "root";
$server_password = "";
$active_database = "notes";

$conn = mysqli_connect($server_name, $username, $server_password, $active_database);
if (!$conn) {
    echo "No Connection!";
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = $_POST['title'];
    $descripit = $_POST['desci'];


    $sql = "INSERT INTO `notes` (`sno`, `title`, `descripition`, `tstamp`) VALUES (NULL, '$title', '    $descripit', current_timestamp());";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $insert = true;
    } else {
        $notinsert = true;
    }
}

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP CRUD</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">


</head>
<style>
.btno
{
    text-decoration: none;
    background-color: black;
    color: white;
    padding: 5px;
    border-radius: 5px;
    font-weight: bolder;

}

</style>

<body>
    <!-- ###############################################################################################33 -->
    <!-- ###############################--NAVIGATION BAR--###########################################33 -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">PHP CRUD</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>


                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <!-- ###############################################################################################33 -->
    <!-- ###############################--FROM --###########################################33 -->
    <?php
    if ($insert) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> Your Note is submitted!.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
    }
    if ($notinsert) {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Alert!</strong> Your Note is  Not submitted!<br>" . mysqli_error($conn) . ".
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
    }

    ?>
    <div class="container my-3">

        <form action="\Crud\index.php" method="POST">
            <h1 class="bg-black" style="color: white; padding-left: 10px;border-radius: 5px;">NOTE</h1>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">

            </div>

            <div class="form-group">
                <label for="desci">Note Discription.</label>
                <textarea class="form-control" id="desci" name="desci" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary my-3">Add Note</button>
        </form>
    </div>

    <div class="container">

        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Sno</th>
                    <th scope="col">Title</th>
                    <th scope="col">Descripition</th>
                    <th scope="col">Action</th>
                </tr>


            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `notes`";

                $result = mysqli_query($conn, $sql);
                $gettingrows = mysqli_num_rows($result);
                // echo "$gettingrows Number of rows of data is in data base";

                if ($gettingrows > 0) {
                    $snow = 1;

                    for ($i = 0; $i < $gettingrows; $i++) {
                        $data = mysqli_fetch_assoc($result);
                        // echo "<br>";
                        // echo "Sno:" . $data['sno'] . "Title" . $data['title'] . "Descripition" . $data['descripition'] . "Time" . $data['tstamp'];
                        // echo "<br>";
                        echo "     <tr>
                        <th scope='row'>" . $snow . "</th>
                        <td>" . $data['title'] . "</td>
                        <td>" . $data['descripition'] . "</td>
                        <td><a class='btno' href='#'>Edit</a> <a class='btno' href='#'>Delete</a></td>
                    </tr>";

                        $snow++;
                    }
                }

                ?>

            </tbody>
        </table>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();

        });

    </script>
</body>

</html>