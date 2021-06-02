<?php 

  include_once 'user.php';
  if(!isset($_SESSION['id']))
  {
        echo '<script> alert("Please Login to View Profile");
                    document.location = "index1.php";
        </script>';
  }
  else
  {
    include('head.php');
    include('modals.php');
    $user = new user();
    $user->setuseremail($_SESSION['email']);
    $userData = $user->getUserByEmail();
  }
?>

<div class="content-wrap">
    <div class="main">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-8 p-r-0 title-margin-right">
            <div class="page-header">
              <div class="page-title">
                <h1>Hello, <?php echo $userData["user_name"]; ?>
                  welcome
                </h1>
              </div>
            </div>
          </div>
          <!-- /# column -->
          <div class="col-lg-4 p-l-0 title-margin-left">
            <div class="page-header">
              <div class="page-title">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="index.php">Dashboard</a>
                  </li>
                  <li class="breadcrumb-item active">App-Profile</li>
                </ol>
              </div>
            </div>
          </div>
          <!-- /# column -->
        </div>
        <!-- /# row -->
        <section id="main-content">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <div class="user-profile">
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="user-photo m-b-30">
                          <img class="img-fluid" src="assets/images/profile-img.png" alt="no profile img" />
                        </div>
                       
                
                      </div>
                      <div class="col-lg-8">
                        <div class="user-profile-name"><?php echo $userData['user_name']; ?></div>
                         <button class="btn btn-primary" id="profileupdate" name="profileupdate">Update Your Profile</button>
                        <div class="custom-tab user-profile-tab">
                          <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                              <a href="#1" aria-controls="1" role="tab" data-toggle="tab">About</a>
                            </li>
                          </ul>
                          <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="1">
                              <div class="contact-information">
                                <h4>Contact information</h4>
                                <div class="phone-content">
                                  <span class="contact-title">Phone:</span>
                                  <span class="phone-number"><?php echo $userData['user_phone'] ?> </span>
                                </div>
                               
                                <div class="address-content">
                                  <span class="contact-title">Address:</span>
                                  <span class="mail-address"><?php echo $userData['user_address'] ?></span>
                                </div>
                                <div class="email-content">
                                  <span class="contact-title">Email:</span>
                                  <span class="contact-email"><?php echo $userData['user_email'] ?></span>
                                </div>
                              </div>
                              <div class="basic-information">
                                <h4>Basic information</h4>
                                <div class="birthday-content">
                                  <span class="contact-title">Age:</span>
                                  <span class="birth-date"><?php echo $userData['user_age'] ?>years</span>
                                </div>
                              </div>
                              

                              
                            <br><br><br><br><br>
<?php 
                             echo '<li><a href="personal-questions.php"><i class="fa fa-plus-circle" aria-hidden="true"></i>Cilck Here to View Personal Questions</a></li>';
                             echo '<li><a href="previous-contests-details.php"><i class="fa fa-plus-circle" aria-hidden="true"></i>Click Here to View Performances in Contests</a></li>';
  // include('tail.php');    
?>



                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /# row -->
         
          <div class="row">
            <div class="col-lg-12">
              <div class="footer">
                <p>2018 © Admin Board. -
                  <a href="#">example.com</a>
                </p>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>



    <script src="assets/js/lib/jquery.min.js"></script>
    <script src="assets/js/lib/jquery.nanoscroller.min.js"></script>
    <script src="assets/js/lib/menubar/sidebar.js"></script>
    <script src="assets/js/lib/preloader/pace.min.js"></script>
    <script src="assets/js/lib/bootstrap.min.js"></script>
    <script src="assets/js/scripts.js"></script>


<?php 
   
  include('tail.php');    
?>



<script>



jQuery(document).ready(function(){
     
      

       
      $(document).on('click', '#profileupdate', function () {
        
        jQuery('#profile_modal').modal('show');
          jQuery.ajax({
            url:'mediator.php',
            method:"POST",
            data:{val:"get-details"},
            dataType:"json",
            success:function(json){
              
              jQuery('#user_name1').val(json[0].user_name);
              jQuery('#user_phone1').val(json[0].user_phone);
              jQuery('#user_address1').val(json[0].user_address);
              jQuery('#user_age1').val(json[0].user_age);
             
            }
          });
          $(document).on('click','#update_profile',function(){
          
            jQuery('#val2').val("update-profile");
            let formdata = jQuery("#user_form1").serialize();
            jQuery.ajax({
              url: "mediator.php",
              method: "POST",
              datatype: "json",
              data:formdata,
            }).done(function(result)
                {
              var data = JSON.parse(result);
                    if(data.status == 0) {
                        alert(data.msg);
                    } else {
                        alert(data.msg);
                        document.location = 'app-profile.php';
                    }
               })
          });

        });
   
    
 
});

</script>

