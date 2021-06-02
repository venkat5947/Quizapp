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
    // include('modals.php');
    $user = new user();
    $user->setuseremail($_SESSION['email']);
    $userData = $user->getUserByEmail();
    
  }
?><table id="prev_contest"  class="col-12 table table-bordered table-striped table-hover datatable datatable-Permission" >
                                <thead>
                                    <tr>
                                        <th style="width:100px">ID</th>
                                        <th style="width:100px">Questions</th>
                                        <th style="width:100px">Score</th>
                                        <th style="width:100px">Topic</th>
                                        <th style="width:100px">Difficulty</th>
                                        <th style="width:100px">Time Taken</th>
                                    </tr>
                                </thead>
                            </table>


<?php include('tail.php') ?>
<script>



jQuery(document).ready(function(){
      let presonal_contests = jQuery("#prev_contest").DataTable({
          "lengthChange": true,
          "paging": true,
          "processing": true,
          "serverSide": true,
          "order":[],
          "columnDefs": [ {
            "targets": [0,1,2,3,4,5],
            "orderable": false,
          } ] ,
          "ajax": {
              url: "action.php",
              type: "POST",
              data:{data:JSON.stringify({action: "previous_contests"})},
              datatype: "json"
          },          
        });


      presonal_contests.on( 'draw.dt', function () {
            var PageInfo = $('#prev_contest').DataTable().page.info();
            presonal_contests.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            } );
        } );

        $(".dataTables_filter").hide();
});

</script>

