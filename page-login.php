<!DOCTYPE html>
<html lang="en">

<head>
   
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

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
                            <a href="index.php"><span>Focus</span></a>
                        </div>
                        <div class="login-form">
                       <!--      <h4>Administratior Login</h4> -->
                           <!-- <div class="col-md-6 col-md-offset-3 sign-in" > -->
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">SIGN IN FORM</h3>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#" onClick="$('.sign-in').hide(); $('.forgot-pass').show()">Forgot Password?</a></div>
                    </div>
                    <div class="panel-body">
                        <form id="sign-in-frm" role="form" method="post" action="" class="form-horizontal">
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
                                                    <div id="result" name="result"></div>
                                                </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon addon-diff-color">
                                        <span class="glyphicon glyphicon-envelope"></span>
                                    </div>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon addon-diff-color">
                                        <span class="glyphicon glyphicon-lock"></span>
                                    </div>
                                    <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                               <input type="checkbox" class="form-control" id="remember-me" name="remember-me" style="width: 30px;"><div style="position: relative; top: -30px; left: 40px;"> Remember Me </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="action" id="action">
                                <input type="submit" value="Login" class="btn btn-warning btn-block" id="login" name="login">
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 control">
                                    <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                        Don't have an account! 
                                    <a href="page-registration.php" >
                                        Sign Up Here
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
                </div>
            </div>
        </div>
    </div>

    <script src="ajax.js"></script>
</body>

</html>

<script type="text/javascript" language="javascript" >
    // function isJson($string) {
    //          json_decode($string);
    //          return (json_last_error() == JSON_ERROR_NONE);
    //         }

    jQuery(document).ready(function(){  
            $('.alert').hide();
            $.ajax({
                url: 'action.php',
                method: 'post',
                dataType:'json',
                data: 'action=checkCookie',
                success: function(result)
                {
                    var data1=JSON.parse(JSON.stringify(result));
                    // console.log(data1);
                    $('#email').val(data1.email);
                    $('#pwd').val(data1.pass);
                }

            })

            $('#email').keyup(function(){
                // var regexp = new RegExp(/^[a-zA-Z]+$/);
                var regexp = /^[a-zA-Z0-9.]+@[a-zA-Z0-9.]+\.[a-zA-Z]{2,4}$/;
                if(regexp.test($('#email').val())) {
                    $('#email').closest('.form-group').removeClass('has-error');
                    $('#email').closest('.form-group').addClass('has-success');
                } else {
                    $('#email').closest('.form-group').addClass('has-error');
                }
            })
        
            $('#pwd').keyup(function(){
                // var regexp = new RegExp(/^[a-zA-Z]+$/);
                var regexp = /^[a-zA-Z0-9]{6,50}$/;
                if(regexp.test($('#pwd').val())) {
                    $('#pwd').closest('.form-group').removeClass('has-error');
                    $('#pwd').closest('.form-group').addClass('has-success');
                } else {
                    $('#pwd').closest('.form-group').addClass('has-error');
                }
            })
            $('#login').click(function(event){
                event.preventDefault();
                $('#action').val("login");
                var config = {};
                jQuery("#sign-in-frm").serializeArray().map(function(item) {
                    if ( config[item.name] ) {
                        if ( typeof(config[item.name]) === "string" ) {
                            config[item.name] = [config[item.name]];
                        }
                        config[item.name].push(item.value);
                    } else {
                        config[item.name] = item.value;
                    }
                });
                // var formData = $('#sign-in-frm').serialize();
                // console.log(formData);
                $.ajax({
                    url: 'action.php',
                    method: 'post',
                    data: {data: JSON.stringify(config)}
                }).done(function(result){
                    console.log(result);
                    var data = JSON.parse(result);
                    if(data.status == 0) {
                        $('.alert').show();
                        $('#result').html(data.msg);
                    } else {
                        // document.location = 'welcome.php';
                        // alert("All ok");
                        document.location = 'index.php';
                    }

                
                    
                })
            })



    });
</script>