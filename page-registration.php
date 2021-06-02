<!DOCTYPE html>
<html lang="en">

<head>

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <title>Focus Admin: Widget</title>

   <!-- ================= Favicon ================== -->
   <!-- Standard -->
   <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
   <!-- Retina iPad Touch Icon-->
   <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
   <!-- Retina iPhone Touch Icon-->
   <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
   <!-- Standard iPad Touch Icon-->
   <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
   <!-- Standard iPhone Touch Icon-->
   <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">

   <!-- Styles -->
   <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
   <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
   <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">
   <link href="assets/css/lib/helper.css" rel="stylesheet">
   <link href="assets/css/style.css" rel="stylesheet">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" />
   <!-- Custom fonts for this template -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css" />
   <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
   <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
</head>

<body class="bg-secondary">

    <div class="unix-login">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="index1.php"><span>Focus</span></a>
                        </div>
                        <div class="login-form">
                         <!--      <h4>Administratior Login</h4> -->
                         <!-- <div class="col-md-6 col-md-offset-3 sign-in" > -->
                            <div class="panel">
                                <div class="panel-body">
                                 <!-- <div class="col-md-6 col-md-offset-3 sign-up"> -->
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <h3 class="panel-title text-center">SIGN UP FORM</h3>
                                        </div>
                                        <div class="panel-body">
                                            <form id="sign-up-frm" role="form" method="post" action="" class="form-horizontal">
                                                <div class="alert alert-danger alert-dismissible" role="alert">
                                                    <div id="result" name="result"></div>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
                                                   
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon addon-diff-color">
                                                            <span class="glyphicon glyphicon-user"></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Full Name">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon addon-diff-color">
                                                            <span class="glyphicon glyphicon-earphone"></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="user_phone" name="user_phone" placeholder="Mobile Number">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon addon-diff-color">
                                                            <span class="glyphicon glyphicon-envelope"></span>
                                                        </div>
                                                        <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Email Address">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon addon-diff-color">
                                                            <span class="glyphicon glyphicon-apple"></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="user_address" name="user_address" placeholder="Enter Address">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon addon-diff-color">
                                                            <span class="glyphicon glyphicon-apple"></span>
                                                        </div>
                                                        <input type="number" class="form-control" id="user_age" name="user_age" placeholder="Enter Age">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon addon-diff-color">
                                                            <span class="glyphicon glyphicon-lock"></span>
                                                        </div>
                                                        <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Password">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon addon-diff-color">
                                                            <span class="glyphicon glyphicon-lock"></span>
                                                        </div>
                                                        <input type="password" class="form-control" id="cfm_pass" name="cfm_pass" placeholder="Confirm Password">
                                                    </div>
                                                </div>
                                                <input type="hidden" name="action" id="action" />
                                                <div class="form-group">
                                                    <input type="submit" value="REGISTER" class="btn btn-warning btn-block" id="register" name="register">
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12 control">
                                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                                            Already have an account! 
                                                            <a href="page-login.php" >
                                                                Sign in Here
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>    
                                            </form>
                                        </div>
                                    </div>
                                    <!-- </div> -->

                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <script src="ajax.js"></script> -->
</body>

</html>



<!-- Bootstrap core JavaScript -->


<script type="text/javascript" language="javascript" >
    // function isJson($string) {
    //          json_decode($string);
    //          return (json_last_error() == JSON_ERROR_NONE);
    //         }

    jQuery(document).ready(function(){  
        $('.alert').hide();

        jQuery(document).on('click','#register', function(e){


          e.preventDefault();
          jQuery('#action').val("create");
          var config = {};
                jQuery("#sign-up-frm").serializeArray().map(function(item) {
                    if ( config[item.name] ) {
                        if ( typeof(config[item.name]) === "string" ) {
                            config[item.name] = [config[item.name]];
                        }
                        config[item.name].push(item.value);
                    } else {
                        config[item.name] = item.value;
                    }
                });
        //   var formData = jQuery('form#sign-up-frm').serialize();
         console.log(config);
         jQuery.ajax({
            url:"action.php",
            method:"POST",
            data: {data: JSON.stringify(config)}

        }).done(function(result)
        {
            // echo result;
            // if(isJson(result)){
            //         alert("Success");
            // }
            // else{
            result = JSON.parse(result)
            if(result.msg=="success")
            {
                alert("SuccessFully Registered Please Login Here");
                document.location="page-login.php";
            }
            else{
            $('.alert').show();
            $('#result').html(result.msg);
            }
            // }
        })
    }); 


        $('#user_name').keyup(function(){

            var regexp = /^[a-zA-Z ]+$/;
            if(regexp.test($('#user_name').val())) {
                $('#user_name').closest('.form-group').removeClass('has-error');
                $('#user_name').closest('.form-group').addClass('has-success');
            } else {
                $('#user_name').closest('.form-group').addClass('has-error');
            }
        })
        
        $('#user_phone').keyup(function(){
                var regexp = /^[0-9]{10}$/;
                if(regexp.test($('#user_phone').val())) {
                    $('#user_phone').closest('.form-group').removeClass('has-error');
                    $('#user_phone').closest('.form-group').addClass('has-success');
                } else {
                    $('#user_phone').closest('.form-group').addClass('has-error');
                }
            })
        
        $('#user_email').keyup(function(){
                var regexp = /^[a-zA-Z0-9.]+@[a-zA-Z0-9.]+\.[a-zA-Z]{2,4}$/;
                if(regexp.test($('#user_email').val())) {
                    $('#user_email').closest('.form-group').removeClass('has-error');
                    $('#user_email').closest('.form-group').addClass('has-success');
                } else {
                    $('#user_email').closest('.form-group').addClass('has-error');
                }
            })

        $('#user_address').keyup(function(){
                var regexp = /([a-zA-z0-9/\\''(),-\s]{2,255})/;
                if(regexp.test($('#user_address').val())) {
                    $('#user_address').closest('.form-group').removeClass('has-error');
                    $('#user_address').closest('.form-group').addClass('has-success');
                } else {
                    $('#user_address').closest('.form-group').addClass('has-error');
                }
            })


        $('#user_age').keyup(function(){
                var regexp = /^[0-9]{1,2}$/;
                if(regexp.test($('#user_age').val())) {
                    $('#user_age').closest('.form-group').removeClass('has-error');
                    $('#user_age').closest('.form-group').addClass('has-success');
                } else {
                    $('#user_age').closest('.form-group').addClass('has-error');
                }
            })

        $('#user_password').keyup(function(){
                var regexp = /^[a-zA-Z0-9]{6,50}$/;
                if(regexp.test($('#user_password').val())) {
                    $('#user_password').closest('.form-group').removeClass('has-error');
                    $('#user_password').closest('.form-group').addClass('has-success');
                } else {
                    $('#user_password').closest('.form-group').addClass('has-error');
                }
            })
        
        $('#cfm_pass').keyup(function(){
                var regexp = /^[a-zA-Z0-9]{6,50}$/;
                if(regexp.test($('#cfm_pass').val())) {
                    if($('#cfm_pass').val() == $('#user_password').val()) {
                        $('#cfm_pass').closest('.form-group').removeClass('has-error');
                        $('#cfm_pass').closest('.form-group').addClass('has-success');
                    } else {
                        $('#cfm_pass').closest('.form-group').addClass('has-error');
                    }
                } else {
                    $('#cfm_pass').closest('.form-group').addClass('has-error');
                }
            })



    });
</script>