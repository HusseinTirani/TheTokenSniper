<?php

include 'header.php';
// include 'config.php'; 


if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];

    $file = $_FILES['imageadd'];

    $filename = $file['name'];
    $fileerror = $file['error'];
    $filetmp = $file['tmp_name'];
    $filestore = explode('.', $filename);
    $filecheck = strtolower(end($filestore));
    $filecheckstore = array('jpg', 'png', 'jpeg');
    $destinationfile = '../images/slider/' . $filename;
    move_uploaded_file($filetmp, $destinationfile);
    mysqli_query($con, "INSERT INTO `promotions`( `name`, `description`, `image`, `from_date`, `to_date`) VALUES ('$name','$description','$destinationfile','$from_date','$to_date')");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($con, "DELETE FROM `promotions` WHERE id='$id'");
}




?>
<div class="container-fluid">
    <h3>Promotions</h3>

    <div class="row">
        <div class="col-12">
            <div class="card">

                <!-- /.card-header -->
                <div class="card-body">
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6"></div>
                            <div class="col-sm-12 col-md-6"></div>
                        </div>

                        <div class="row mx-0 px-0 ">
                            <div class="col-12 py-3 px-0 mx-0 ">
                                <h5 class="font-weight-bold">Add Banner</h5>
                                <form action="" method="POST" class=""  enctype="multipart/form-data">
                                    <div class="custom-file ">
                                        <input type="file" name="imageadd" class="custom-file-input" id="exampleInputFile" >
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <input type="text" name="name" class="form-control mt-3  " placeholder="Name">
                                    <input type="text" name="description" class="form-control mt-3  " placeholder="Description">
                                    <input type="date" name="from_date" class="form-control mt-3  " >
                                    <input type="date" name="to_date" class="form-control mt-3  " >
                                    <input type="submit" name="submit" class="form-control mt-3 btn btn-primary" value="Add">
                                </form>
                            </div>
                            <div class="col-sm-12 px-0" style="overflow-x: scroll;">
                                <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting sorting_asc">Id</th>
                                            <th class="sorting sorting_asc">Image</th>
                                            <th class="sorting sorting_asc">Name</th>
                                            <th class="sorting sorting_asc text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $sql = mysqli_query($con, "SELECT * FROM `promotions`");

                                        foreach ($sql as $result) {
                                            echo '
                                            <tr role="row">
                                            <td class="sorting sorting_asc">' . $result['id'] . '</td>
                                            <td class="sorting sorting_asc"><a href="' . $result['image'] . '" class="w-100"><img src="' . $result['image'] . '" width="100%"></a> </td>
                                            <td class="sorting sorting_asc">' . $result['name'] . '</td>
                                            
                                            <td class="sorting sorting_asc d-flex ">
                                                <a href="?delete=' . $result['id'] . '" class="btn btn-danger w-100 mr-1">Delete</a>
                                                <a href="updatepromotions.php?id=' . $result['id'] . '" class="btn btn-success w-100">Update</a>
                                            </td>
                                             </tr>';
                                        }

                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->


            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<?php include 'footer.php'; ?>