<?php 
  require 'config.php';

  //define variables and initialize with empty values
  $name = $address = $salary ="";
  $name_err = $address_err = $salary_err = "";

  //processing form data when form is submitted
  if($_SERVER["REQUEST_METHOD"] == "POST"){
     // validate name
     $input_name = trim($_POST["name"]);
     if(empty($input_name)){
      $name_err = "Please enter a name.";
     }elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
      $name_err = "Please enter a valid name.";
     }else{
      $name = $input_name;
     }

     //validate address
     $input_address = trim($_POST["address"]);
     if(empty($input_address)){
         $address_err = "Please enter an address.";     
     } else{
         $address = $input_address;
     }

     //validate salary
     $input_salary = trim($_POST["salary"]);
     if(empty($input_salary)){
        $salary_err = "please enter the salary";
     }elseif(!ctype_digit($input_salary)){
      $salary_err = "Please enter a positive integer value.";
     }else{
      $salary = $input_salary;
     }
    //check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($salary_err)){
       // Prepare an insert statement
       $sql = "INSERT INTO employee (name, address, salary) VALUES (?, ?, ?)";
 
       if($stmt = $mysqli->prepare($sql)){
           // Bind variables to the prepared statement as parameters
           $stmt->bind_param("sss", $param_name, $param_address, $param_salary);
           
           // Set parameters
           $param_name = $name;
           $param_address = $address;
           $param_salary = $salary;
           
           // Attempt to execute the prepared statement
           if($stmt->execute()){
               // Records created successfully. Redirect to landing page
               header("location: index.php");
               exit();
           } else{
               echo "Oops! Something went wrong. Please try again later.";
           }
       }
        
       // Close statement
       $stmt->close();

    }
    mysqli_close($mysqli);
  }
    

 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create</title>
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
          <h2 class="mt-5">Create Record</h2>
          <p>Please fill this form and submit to add employee record to the database.</p>
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
               <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control <?php echo (!empty($name_err))? 'is-invalid':'';?>" value="<?php echo $name;?>">
                <span class="invalid-feedback"><?php echo $name_err;?></span>
               </div>
               <div class="form-group">
                <label>Address</label>
                <textarea type="text" name="address" class="form-control <?php echo (!empty($address_err))? 'is-invalid':'';?>"><?php echo $address;?></textarea>
                <span class="invalid-feedback"><?php echo $address_err;?></span>
               </div>
               <div class="form-group">
                <label>Salary</label>
                <input type="text" name="salary" class="form-control <?php echo (!empty($salary_err))? 'is-invalid':'';?>" value="<?php echo $salary;?>">
                <span class="invalid-feedback"><?php echo $salary_err;?></span>
               </div>
               <input type="submit" class="btn btn-primary" value="Submit">
               <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>