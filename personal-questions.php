<?php 

  include_once 'user.php';
  if(!isset($_SESSION['id']))
  {
        echo '<script> alert("Please Login to View Personal Questions");
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
<table id="personal-que"  class="col-12 table table-bordered table-striped table-hover datatable datatable-Permission" >
                                <thead>
                                    <tr>
                                        <th style="width:150px">ID</th>
                                        <th style="width:10000px">Question</th>
                                        <th style="width:100px"></th>
                                        <th style="width:100px"></th>
                                    </tr>
                                </thead>
                            </table>  


<?php include('tail.php') ?>
<script>



jQuery(document).ready(function(){
     // alert("hi");
      let t = jQuery("#personal-que").DataTable({
          "lengthChange": true,
          // "pagingType": "full_numbers",
          "paging": true,
          "processing": true,
          "serverSide": true,
          "order":[],
          "info":false,
          "columnDefs": [ {
            "targets": [0,1,2,3],
            "orderable": false,
          } ] ,
        "ajax": {
            url: "mediator.php",
            type: "POST",
            data:{data:JSON.stringify({val:"personal-que"})},
            datatype: "json"
        },          
      });
      
      t.on( 'draw.dt', function () {
            var PageInfo = $('#personal-que').DataTable().page.info();
            t.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            } );
        } );


        

        $(".dataTables_filter").hide();
     
      
    $(document).on('click', '.edit', function () {
          let i = jQuery(this).data('id');

          jQuery.ajax({
            url:'mediator.php',
            method:"POST",
            data:{qid:i, val:"edit-que"},
            dataType:"json",
            success:function(json){
              // console.log(json);
              jQuery('#updateQueModal').modal('show');
              jQuery('#topic').val(json[0].topic);
              jQuery('#subject').val(json[0].subject);
              jQuery('#discription').val(json[0].discription);
              jQuery('#opt1').val(json[0].opt_a);
              jQuery('#opt2').val(json[0].opt_b);
              jQuery('#opt3').val(json[0].opt_c);
              jQuery('#opt4').val(json[0].opt_d);
              jQuery('#opt5').val(json[0].opt_e);
              jQuery('#ans').val(json[0].correct_ans);
              jQuery('#explanation').val(json[0].explanation);
            }
          });
          $(document).on('click','#update',function(){
          // let i = jQuery(this).data('id');
                jQuery('#qid').val(i);
                jQuery('#val1').val("update-que");
                let formdata = jQuery("#update_que_form").serialize();
                jQuery.ajax({
                  url: "mediator.php",
                  method: "POST",
                  datatype: "json",
                  data:formdata,
                  success:function(){
                    t.ajax.reload();
                    // jQuery('#updateQueModal').modal('hide');
                   
                  }
                })
           });

        });

        $(document).on("click",'.delete',function(){
          let i = jQuery(this).data('id');
          jQuery.ajax({
            url:"mediator.php",
            method: "POST",
            data: {qid:i, val:"delete-que"},
            success: function(){
              alert("done");
              t.ajax.reload();
            }
          })

        });

    
 
});

</script>

