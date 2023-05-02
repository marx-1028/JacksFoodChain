<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['fosaid']==0)) {
  header('location:logout.php');
  } else{
if(isset($_POST['submit']))
  {
    $id = $_GET['ID'];
    $reserve_id = $_POST['reserve_id'];
    $no_of_guest = $_POST['no_of_guest'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date_res = $_POST['date_res'];
    $time = $_POST['time'];
    $suggestions = $_POST['suggestions'];
   

    $query=mysqli_query($con, "update tblreservation set no_of_guest ='$no_of_guest', email ='$email', phone ='$phone', date_res ='$date_res', time ='$time', suggestions ='$suggestions' where ID='$id'");


    if ($query) {
    $msg="Reservation has been updated";
  }
  else
    {
      $msg="Something Went Wrong. Please try again";
    }
}

 ?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Food Ordering System</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/plugins/steps/jquery.steps.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

    <?php include_once('includes/leftbar.php');?>

        <div id="page-wrapper" class="gray-bg">
             <?php include_once('includes/header.php');?>
        <div class="row border-bottom">
       
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Edit Reservation</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="dashboard.php">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a>Reservation Details</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Update</strong>
                    </li>
                </ol>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        
                        <div class="ibox-content">
                            <p style="font-size:16px; color:red;"> <?php if($msg){
    echo $msg;
  }  ?> </p> 
  

                            <form id="submit" action="#" class="wizard-big" method="post" name="submit">
                                    <fieldset>
                                          <div class="form-group row"><label class="col-sm-2 col-form-label">No of guest:</label>
                                                <div class="col-sm-10"><input name='no_of guest' id="no_of_guest" class="form-control white_bg" value="<?php  echo $row['no_of_guest'];?>">
     
       
                                            </div>
                                            </div>
                                            <div class="form-group row"><label class="col-sm-2 col-form-label">Email:</label>
                                                <div class="col-sm-10"><input type="text" class="form-control" name="email" value="<?php  echo $row['email'];?>"></div>
                                            </div>
                    
                                            
                                            <div class="form-group row"><label class="col-sm-2 col-form-label">Mobile Number:</label>
                                                <div class="col-sm-10"><input type="Number" class="form-control" name="phone"  value="<?php  echo $row['phone'];?>">
                                            </div>
                                            </div>

                                            <div class="form-group row"><label class="col-sm-2 col-form-label">Reservation Date:</label>
                                                <div class="col-sm-10"><input type="date" class="form-control" name="date"  value="<?php  echo $row['date_res'];?>"></div>
                                            </div>

                                            <div class="form-group row"><label class="col-sm-2 col-form-label">Time:</label>
                                                <div class="col-sm-10"><input type="time" class="form-control" name="time"  value="<?php  echo $row['time'];?>">
                                                </div></div>

                                           

                                            <div class="form-group row" ><label class="col-sm-2 col-form-label" >Reservation Date:</label>
                                                <div class="col-sm-10">
                                                <select name="status" style=" border-width:3px;border-style:solid height:400px; width:300px">
                                                  <option value="" align="center">Status</option>
                                                  <option value="Confirm">Confirm</option>
                                                  <option value="Pending">Pending</option>
                                                  <option value="Cancel">Cancel</option>
                                                </select>
                                                </div>



                                           
                                        </fieldset>

                                </fieldset>
                                <?php } ?>
                                
                            
                               
  
          <p style="text-align: center;"><button type="submit" name="submit" class="btn btn-primary">Update</button></p>
            
                                
                               
                            </form>
                        </div>
                    </div>
                    </div>

                </div>
            </div>
        <?php include_once('includes/footer.php');?>

        </div>
        </div>



    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- Steps -->
    <script src="js/plugins/steps/jquery.steps.min.js"></script>

    <!-- Jquery Validate -->
    <script src="js/plugins/validate/jquery.validate.min.js"></script>


    <script>
        $(document).ready(function(){
            $("#wizard").steps();
            $("#form").steps({
                bodyTag: "fieldset",
                onStepChanging: function (event, currentIndex, newIndex)
                {
                    // Always allow going backward even if the current step contains invalid fields!
                    if (currentIndex > newIndex)
                    {
                        return true;
                    }

                    // Forbid suppressing "Warning" step if the user is to young
                    if (newIndex === 3 && Number($("#age").val()) < 18)
                    {
                        return false;
                    }

                    var form = $(this);

                    // Clean up if user went backward before
                    if (currentIndex < newIndex)
                    {
                        // To remove error styles
                        $(".body:eq(" + newIndex + ") label.error", form).remove();
                        $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                    }

                    // Disable validation on fields that are disabled or hidden.
                    form.validate().settings.ignore = ":disabled,:hidden";

                    // Start validation; Prevent going forward if false
                    return form.valid();
                },
                onStepChanged: function (event, currentIndex, priorIndex)
                {
                    // Suppress (skip) "Warning" step if the user is old enough.
                    if (currentIndex === 2 && Number($("#age").val()) >= 18)
                    {
                        $(this).steps("next");
                    }

                    // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                    if (currentIndex === 2 && priorIndex === 3)
                    {
                        $(this).steps("previous");
                    }
                },
                onFinishing: function (event, currentIndex)
                {
                    var form = $(this);

                    // Disable validation on fields that are disabled.
                    // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                    form.validate().settings.ignore = ":disabled";

                    // Start validation; Prevent form submission if false
                    return form.valid();
                },
                onFinished: function (event, currentIndex)
                {
                    var form = $(this);

                    // Submit form input
                    form.submit();
                }
            }).validate({
                        errorPlacement: function (error, element)
                        {
                            element.before(error);
                        },
                        rules: {
                            confirm: {
                                equalTo: "#password"
                            }
                        }
                    });
       });
    </script>

</body>

</html>
</fieldset>
