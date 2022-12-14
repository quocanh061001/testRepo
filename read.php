<?php 
//check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
  include "config.php";

  //prepare a select statement
  $sql = "select * from employee where id = ?";
  
  if($stm = $mysqli->prepare($sql)){
    //bind variable to the prepared statement as parameters
    $stm->bind_param("s", $param_id);

    //set parameters
    $param_id = trim($_GET["id"]);

    //Attempt to execute the prepared statement
    if($stm->execute()){
      $result = $stm->get_result();
      if($result->num_rows == 1){
          //fetch result row as an associative array. since the result set contains only one row, we dont need to use while loop
          $row = $result->fetch_array();
          //retrieve individual field value
          $name = $row["name"];
          $address = $row["address"];
          $salary = $row["salary"];

      }else{
                    // URL doesn't contain valid id parameter. Redirect to error page
                    header("location: error.php");
                    exit();
      }
    }else{
      echo "Oops! Something went wrong. Please try again later.";
    }
  }
   // Close statement
   $stm->close();
    
   // Close connection
   $mysqli->close();
}else{
  // URL doesn't contain id parameter. Redirect to error page
  header("location: error.php");
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px; 
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Record</h1>
                    <div class="form-group">
                        <label>Name</label>
                        <p><b><?php echo $name; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <p><b><?php echo $address; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Salary</label>
                        <p><b><?php echo $salary; ?></b></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
