<?php 
  require 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
</head>
<body>
  <div class="wrapper">
     <div class="container-fluid">
          <div class="row">
               <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                         <h2 class="pull-left">Employees Details</h2>
                         <a href="create.php" class="btn btn-success pull-right">
                             <i class="fa fa-plus"></i> Add new employees </a>
                    </div>
                    <?php 
                      $sql = "select * from employee";
                      $result = $mysqli->query($sql);
                   
                        if($result->num_rows > 0)
                        {
                    ?>
                      <table class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th>id</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Salary</th>
                                <th>Action</th>
                                
                              </tr>
                            </thead>
                            <tbody>
                              <?php 
                                while($row = $result->fetch_assoc()){
                              ?>
                              <tr>
                                <td><?php echo $row['id'] ?></td>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['address'] ?></td>
                                <td><?php echo $row['salary'] ?></td>
                                <td>
                                  <a href="read.php?id=<?php echo $row['id'] ?>" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>
                                  <a href="update.php?id=<?php echo $row['id'] ?>" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>
                                  <a href="delete.php?id=<?php echo $row['id'] ?>" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>
                                </td>
                              </tr>
                              <?php } ?>
                            </tbody>
                      </table>
                    <?php }else{
                     ?>
                     <div class="alert alert-danger"><em>No records were found.</em></div>
                     <?php } 
                       $mysqli->close();
                     ?>
               </div>
          </div>
     </div>
  </div>
</body>
</html>