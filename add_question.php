<?php

include('user.php');
$que = new user();
// echo $que->returnConnection();
include("head.php");
$sql = "select distinct topic from questions;" ;
$sql1 = "select distinct subject from questions;" ;
$stmt1= $que->db->prepare($sql1);
$stmt= $que->db->prepare($sql);
$stmt->execute();
$stmt1->execute();
$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
$result1 = $stmt1->fetchAll(\PDO::FETCH_ASSOC);
?>
<h2>Import Excel File into MySQL Database using PHP</h2>
    <h5 style="color:blue;">Keep the Order of Excel File Cloumns as  </h5>
    <h5 style="color:red;"> discription,Topic,difficulty,subject,opt_a,opt_b,opt_c,opt_d,opt_e(keep empty if not there),correct_ans,Explanation</h5>
    <div class="outer-container">
        <form action="" method="post"
            name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
            <div>
                <label>Choose Excel
                    File</label> <input type="file" name="file"
                    id="file" accept=".xls,.xlsx,.csv">
                <!-- <input  id="submit" name="import" val="Import"/> -->
                <!-- <input type="submit" id="submit" name="import" > -->
                 <button type="submit" class="btn btn-warning" name="import" id="submit"  >Add</button>
        
            </div>
        
        </form>
        
    </div>
    <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
    
<h1> OR </h1>
<h1 class="text-center">Add Question</h1>



<!-- <div class="container">

<form class="form-inline">
	<div class="form-group">
	  <label for="files">Enter a Csv to directly add: </label>
	  <input type="file" id="csv_upload"  class="form-control" accept=".csv" required />
	</div>
	<div class="form-group">
    <button type="button" class="btn btn-success" name="bulk_upload" id="bulk_upload"  >Bulk Upload</button>
	 </div>
</form>
<p> OR </p>
</div> -->
        <div class="container">
        <form method = 'POST' id='add-question'>
            <div class="form-group">
                <label>Subject:</label>
                <select name="subject" id="subject">
                         <option value="">--Select Subject--</option>
                </select>
                
            </div>
            <div class="form-group">
                <label>Topic:</label>
                <select id="topic">
                
                </select>
                <div class="form-group other_topic_div">
                    <h6> Other topic Name</h6>
                    <input type="text" id="other_topic_name" required="required"><br>
                    <h6> Other topic Discription</h6>
                    <input  id="other_topic_disc" class="form-control" style="height:100px;"><br>
                </div>

            </div>
            <div class="form-group">
                <label>Difficulty:</label>
                <select name="difficulty" id="difficulty">
                    <option value="medium">Medium</option>
                    <option value="hard">Hard</option>
                    <option value="easy">Easy</option>
                </select>
                
            </div>      
                        
            

            <div class="form-group">
                <label for="discription">Question: </label>
                <textarea name="discription" id="discription" class="form-control" required="required" style="height:200px;"></textarea>
            </div>
            <div class="form-group">
                <label for="opt1">option A: </label>
                <input type="text" class="form-control" id="opt1" name="opt1" required="required">
            </div>
            <div class="form-group">
                <label for="opt2">option B: </label>
                <input type="text" class="form-control" id="opt2" name="opt2" required="required">
            </div>
            <div class="form-group">
                <label for="opt3">option C: </label>
                <input type="text" class="form-control" id="opt3" name="opt3" required="required">
            </div>
            <div class="form-group">
                <label for="opt4">option D: </label>
                <input type="text" class="form-control" id="opt4" name="opt4" required="required">
            </div>
            <div class="form-group">
                <label for="opt5">option E: </label>
                <input type="text" class="form-control" id="opt5" name="opt5">
            </div>
            <div class="form-group">
                <label>Correct_ans:</label>
                <select name="ans" id="ans">
                    <option value="a">A</option>
                    <option value="b">B</option>
                    <option value="c">C</option>
                    <option value="d">D</option>
                    <option value="e">E</option>
                </select>
                
            </div>
            <div class="form-group">
                
                <label for="explanation">Explanation: </label>
                <textarea name="explanation" id="explanation" class="form-control" rows="6" name="explanation" required="required"  style="height:200px;"></textarea>
            </div>
            <button type="button" class="btn btn-success" name="add" id="add"  >Add</button>
            <!-- <input type="submit"  class="btn btn-success" name="add" id="add" placeholder="Add" /> -->
            <!-- <button type="submit" class="btn btn-primary" id="add" name="add">Add</button> -->
            <input type="hidden" name="topic_disc" id="topic_disc_var" value="">
            <input type="hidden" name="topic" id="topic_var">
            <input type="hidden" name="topic_flag" id="topic_flag" value=0>
            
            </form>
        </div>
        </div>
    </div>
</div>


    
<?php
    include("tail.php");
?>
<script type="text/javascript" language="javascript">
        jQuery(document).ready(function(){
             $('.other_topic_div').hide();
             $('#frmExcelImport').submit(function(e){
                    e.preventDefault();
                    alert("hllo");
                    let myForm =$('#frmExcelImport')[0];
                    // var data=jQuery('form#frmExcelImport');
                    let data = new FormData();
                    data.append('file', document.getElementById("file").files[0]);
                    data.append("import",true);
                    // alert(data);
                    // console.log(data);
                    for (var key of data.entries()) {
                              console.log(key[0] + ', ' + key[1]);
                   }

                    jQuery.ajax({
                        url:"bulk-upload.php",
                        method:"POST",
                        data:data,
                         processData: false,
                        contentType: false
                        // data:{str:string,subject:subject},
                        // success: function(data)
                        // {
                            // if(string=="gettopic")
                                 // {$("#topic").html(data); }
                            // else {$("#subject").append(data); }
                        // }
                    })

                 });
            
             function loaddata(string,subject)
             {
                    $.ajax({
                        url:"get-subject-topic.php",
                        method:"POST",
                        data:{data:JSON.stringify({str:string,subject:subject})},
                        success: function(data)
                        {
                            console.log(data)
                            data = JSON.parse(data)
                            console.log(data)
                            if(string=="gettopic")
                                 {
                                     $("#topic").html(data.topics); 
                                }
                            else {$("#subject").append(data.subjects); }
                        }
                    })
             }
             loaddata("");
             $('#subject').on("change",function()
             {
                $('.other_topic_div').hide();
                var subject=$('#subject').val();
                if(subject!=""){
                loaddata("gettopic",subject);
                }
                else{
                    $('#topic').html("");
                }
             })
             $('#topic').on("change",function()
             {
                var topic=$('#topic').val();
                if(topic=="other_topic"){
                    $('.other_topic_div').show();
                }
                else{
                    $('.other_topic_div').hide();
                }
             })
            
            jQuery(document).on('click', "#add", function(e) {
                var crct_opt =  $('#ans').val();
                if( $('#topic').val()=="other_topic" && $('#other_topic_name').val()=="" )
                {
                    alert("Please add Topic");
                    return ;
                }
                if( $('#opt'+crct_opt).val()=='' || $('#subject').val()=='' || $('#topic').val()=='' ){
                    alert("Please Check the inputs again");
                    return;
                }
                else $('#wrng').hide();

                if($('#topic').val() == 'other_topic'){
                    $('#topic_flag').val(1);
                    $("#topic_var").val( $('#other_topic_name').val() );
                    if($('#other_topic_disc').val()!=""){
                        $("#topic_disc_var").val( $('#other_topic_disc').val() );
                    }
                }
                else{
                    $("#topic_var").val( $('#topic').val() );
                }
                var config = {};
                jQuery("form").serializeArray().map(function(item) {
                    if ( config[item.name] ) {
                        if ( typeof(config[item.name]) === "string" ) {
                            config[item.name] = [config[item.name]];
                        }
                        config[item.name].push(item.value);
                    } else {
                        config[item.name] = item.value;
                    }
                });
                // var formData = JSON.stringify(jQuery('form').serializeObject());
                jQuery.ajax({
                    url: 'add-que-back.php',
                    method: 'POST',
                    dataType:'json',
                    data: {data:JSON.stringify(config)},
                    success: function(data) {
                        alert(data.message);
                        $('#add-question')[0].reset();
                        $('.other_topic_div').hide();
                    },
                    error: function() {
                        alert("Please Check the inputs again");
                    }
                })

            });
        })
</script>