<!-- 
  easy: 1
  medium: 2
  hard: 3

  score/difficulty

conteset table: contest_id, user_id, total_questions, score, topic, difficulty, time_stamp

Answers Table: ans_id, question_id, user_id, user_ans, right_ans, date

 -->


<?php
   // session_start();
   // $_SESSION['score']=0;
include('user.php');
$que=new user();
include("head.php");
// include("modals.php");
  // $_SESSION=$_POST;
  
 ?>


<!-- Start Contest Modal -->
<div id="contestmodal" class="modal fade"  >
 <div class="modal-dialog">
  <form method="post" id="user_form" enctype="multipart/form-data">
   <div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title"> Start Contest</h4>
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     
    </div>
    <div class="modal-body">
                
                <div class="form-group">
                    <label>No of Questions:</label>

                      <select name="ques" id="ques">
                        <option value="20">20</option>
                        <option value="10">10</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                      </select>
                </div>
                <div class="form-group">
                    <label>difficulty</label>

                    <select name="diff" id="diff">
                      <option value="all">All</option>
                      <option value="easy">EASY</option>
                      <option value="medium">Medium</option>
                      <option value="hard">Hard</option>
                    </select>

                </div>
                <div class="form-group">
		                <label>Subject:</label>
		                <select name="subject" id="subject">
		                         <option value="all">--All--</option>
		                </select>
                
            	</div>

                
                <div class="form-group" id='hide_topic'>
                    <label>Topics:</label>
                    <select name="topic" id="topic">
                    		<option value="any">Any Topic</option> 
                    </select>
                </div>
  

    </div>
    <div class="modal-footer">
     <input type="hidden" name="id" id="id" />
     <input type="hidden" name="operation" id="operation" />
     <!-- <input type="submit" name="update" id="update" class="btn btn-success" value="UPDATE" /> -->
     <button type="button" class="btn btn-success" name="start" id="start"  >Start</button>
     <button id="closemodal" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
   </div>
  </form>
 </div>
</div>

  <div>  <p id="hours"></p> 
    <p id="mins"></p>
    <p id="secs"></p>
    <h2 id="end"></h2>

</div>


  <button id="final_submit" name="final_submit">Final Submit</button>
  <br>

  <table id="contest_score" style="width:100%" class="col-12 table table-bordered table-striped table-hover datatable datatable-Permission" >
    <thead>
        <tr>
            <th style="text-align: center;width:100px">SCORE</th>
			<th style="text-align: center;width:100px">Not Attempted</th>
			<th style="text-align: center;width:100px">Attempted</th>
			<th style="text-align: center;width:100px">Correct Ans</th>
			<th style="text-align: center;width:100px">Wrong Ans</th>
			<th style="text-align: center;width:100px">Time Taken</th>
        </tr>
    </thead>
</table>
<br>
<table id="contest_ques" style="width:100%" class="col-12 table table-bordered table-striped table-hover datatable datatable-Permission" >
    <thead>
        <tr>
            <th style="text-align: center;width:100px">S.No</th>
            <th style="text-align: center;width:10000px">Question</th>
        </tr>
    </thead>
</table>
<br>
<table id="contest_ans" style="width:100%" class="col-12 table table-bordered table-striped table-hover datatable datatable-Permission" >
    <thead>
        <tr>
            <th style="text-align: center;width:100px">S.No</th>
            <th style="text-align: center;width:10000px">Question</th>
        </tr>
    </thead>
</table>

 <?php
  include("tail.php");
  
 ?>
 <script type="text/javascript">

 	       $(window).on("beforeunload", function() {
 	       	event.preventDefault();
 	       	// alert("Do you really want to exit");
			return event.returnValue="Are you sure? You didn't finish the form!";
		});
		 	jQuery(document).ready(function(){
		 		$('#hide_topic').hide();
		 		function loaddata(string,subject)
             {
                    $.ajax({
                        url:"get-subject-topic.php",
                        method:"POST",
                        data:{data:JSON.stringify({str:string,subject:subject})},
                        success: function(result)
                        {	
							result = JSON.parse(result)
                            if(string=="gettopic") {
								$('#topic').empty()
								$("#topic").append(result.topics);
							}
                            else $("#subject").append(result.subjects);
                        }
                    })
             }
             loaddata("");

             $('#subject').on("change",function()
             {
                var subject=$('#subject').val();
                if(subject!="all"){
                loaddata("gettopic",subject);
                $('#hide_topic').show();
                }
                else{
                	$('#hide_topic').hide();
                    // $('#topic').html("Any");
                }
             })
            



 		        var arr={};
				$('#contest_ans').hide();
				$('#contest_score').hide();
 		        function endexam()
			    {
			    	    var userStr = JSON.stringify(arr);
						console.log(userStr)
			            $('#contest_ques').parents('div.dataTables_wrapper').first().hide();
			             $('#contest_ans').parents('div.dataTables_wrapper').first().show();
			            // $('#contest_ques').hide();
			            $('#end').hide();
			            $('#hours').hide();
			            $('#mins').hide();
			            $('#secs').hide();
			            $('#final_submit').hide();
						$('#contest_ans').show();
						$('#contest_score').show();
						// Contest Ans Table
						let answrs = jQuery("#contest_ans").DataTable({
							"lengthChange": false,
							"paging": false,
							"processing": false,
							"serverSide": true,
							"info":false,
							"order":[],
							"columnDefs": [ {
						      "targets": [0,1],
						      "orderable": false,
					                     } ] ,
							"ajax": {
							url: "mediator.php",
							type: "POST",
							data:{data: JSON.stringify({user_ans:userStr, val:"score-calc"})}
							}
								
						});
						$(".dataTables_filter").hide();

						answrs.on( 'draw.dt', function () {
						var PageInfo = $('#contest_ans').DataTable().page.info();
						t.column(0, { page: 'current' }).nodes().each( function (cell, i) {
							cell.innerHTML = i + 1 + PageInfo.start;
									} );
						} );

						// Contest Score Table
						let score_table = jQuery("#contest_score").DataTable({
							"lengthChange": false,
							"paging": false,
							"processing": false,
							"serverSide": true,
							"order":[],
							"bInfo":false,
							"columnDefs": [ {
						          "targets": [0,1,2,3,4,5],
						           "orderable": false,
			             		} ] ,
							"ajax": {
							url: "mediator.php",
							type: "POST",
								data:{data:JSON.stringify({user_ans:userStr, diff: $('#diff').val(),topic : $('#topic').val(), val: "score-table-creation",subject:$('#subject').val()})}
							}
								
						});
						$(".dataTables_filter").hide();
						$(window).off("beforeunload");

			    }

	  
 		       jQuery('#contestmodal').modal('show');
 		       $(document).on('click','#closemodal',function(){
             document.location = 'index.php';
 		      });


 		       $(document).on('click','#start',function()
 		{
			 
			
                var count_ques=jQuery('#ques').val();
			             // document.location = 'index.php';
			// The data/time we want to countdown to

			    var countDownDate = new Date().getTime()+120000*count_ques+2000;

			    // Run myfunc every second
			    var myfunc = setInterval(function() {
					


					    

						var now = new Date().getTime();
						var timeleft = countDownDate - now;
							
						// Calculating the days, hours, minutes and seconds left
						var days = Math.floor(timeleft / (1000 * 60 * 60 * 24));
						var hours = Math.floor((timeleft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
						var minutes = Math.floor((timeleft % (1000 * 60 * 60)) / (1000 * 60));
						var seconds = Math.floor((timeleft % (1000 * 60)) / 1000);
							
						// Result is output to the specific element
						if(hours>=1){
						document.getElementById("hours").innerHTML = hours + "h " 
									}
						else
							{
							document.getElementById("hours").innerHTML = "" 
							}
						if(minutes>=1){
							document.getElementById("mins").innerHTML = minutes + "m " 
									}
						else
						{
							document.getElementById("mins").innerHTML = "";
							if(seconds%2==1)
							document.getElementById("secs").style.color = "red";
							else
							document.getElementById("secs").style.color = "black";
						
							
						}
						document.getElementById("secs").innerHTML = seconds + "s " ;	
						// Display the message when countdown is over
						
						if (timeleft < 0) {
							clearInterval(myfunc);
						
							document.getElementById("hours").innerHTML = "" 
							document.getElementById("mins").innerHTML = ""
							document.getElementById("secs").innerHTML = ""
							document.getElementById("end").innerHTML = "TIME UP!!";
							endexam();
						}
			}, 1000);
			//  $('#contest_ques').dataTable({ "bSort" : false } );
             jQuery('#contestmodal').modal('hide');

             let t = jQuery("#contest_ques").DataTable({
				   
		          "lengthChange": false,
		          // "pagingType": "full_numbers",
		          "paging": false,
		          "processing": false,
		          "serverSide": true,
		          "order":[],
				  "info":false,
					"columnDefs": [ {
						"targets": [0,1],
						"orderable": false,
					} ] ,
		           "ajax": {
						url: "mediator.php",
						type: "POST",
						datatype: "json",
						data:{data: JSON.stringify({no_of_ques:count_ques, diff: $('#diff').val(),topic : $('#topic').val(), val:"contest-questions",subject:$('#subject').val()})}
		            }, 
					     
		         });
				 $(".dataTables_filter").hide();
		         t.on( 'draw.dt', function () {
		            var PageInfo = $('#contest_ques').DataTable().page.info();
		            t.column(0, { page: 'current' }).nodes().each( function (cell, i) {
		                cell.innerHTML = i + 1 + PageInfo.start;
		                 } );
                   } );
			   

		       $(document).on('click','.radio',function()
		       {
					let i = jQuery(this).data('id'), opt = jQuery('input[name="opt'+i+'"]:checked').val();
                     arr[i.toString()]=opt;
		       })
			   $(document).on('click','.clear',function()
		       {
					let i = jQuery(this).data('id');
					let temp = i.toString();
					delete arr[temp]; 
					jQuery('input[name="opt'+i+'"]').prop('checked',false);
		       })
		       $(document).on('click','#final_submit',function()
		       {
		       	endexam();

		       })
		       
 		});
 		

 	});

 </script>