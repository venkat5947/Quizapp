<?php
    session_start();
    include("head.php");
    if(! isset($_SESSION['count'])){
        $_SESSION['count']=0;
    }
?>                    



<table id="questions" style="width:100%" class="col-12 table table-bordered table-striped table-hover datatable datatable-Permission" >
    <thead>
        <tr>
            <th style="text-align: center;width:100px">S.No</th>
            <th style="text-align: center;width:10000px">Question</th>
        </tr>
    </thead>
</table>




<?php include("tail.php");?>



<script>
    jQuery(document).ready(function() { 
        // $('.alert').hide(); 
        let data = JSON.stringify({val:"problem-set"})
        // data.val = "problem-set"
        var t = jQuery('#questions').DataTable({
            
            "lengthChange": true,
            "paging": true,
            "processing": true,
            "serverSide": true,
            "order":[],
            "lengthMenu":[10,5,1,20,25,30,50,100,200],
            "ajax": {
                url: "mediator.php",
                type: "POST",
                dataType: "json",
                data:{data:data},
                complete: function (){
                    $('.alert').hide();
                },
            },          
        });

        t.on( 'draw.dt', function () {
            var PageInfo = $('#questions').DataTable().page.info();
            t.column(0, { page: 'current' }).nodes().each( function (cell, i) {
                cell.innerHTML = i + 1 + PageInfo.start;
            } );
        } );

        jQuery(document).on('click','.show',function(){
            let i = jQuery(this).data('id');
            // alert(i);
            jQuery('#'+i+'show').show();
        });

        jQuery(document).on('click','.radio',function() {
            // alert("lol");
            $('.alert').hide(); 

            // var sessionValue = '<%=$_SESSION["id"] != null%>';
            
            let i = jQuery(this).data('id'), opt = jQuery('input[name="opt'+i+'"]:checked').val();
            // alert("clicked"+jQuery(this).data('id')+opt);
            // console.log("clicked"+jQuery(this).data('id')+op t);
            let data = JSON.stringify({val:"question-validate",id:i,opt:opt})
            jQuery.ajax({
                url: "mediator.php",
                type: "POST",
                dataType: "json",
                data: {data: data},
                success:function(result){
                if (result.value==1) $('#'+i+'crct').show()
                else $('#'+i+'wrng').show()
                }
            }).fail(function(result){
                    if(confirm("Your attempts are over, please login first\n\n Do You want to visit login page?")){
                        document.location='page-login.php';
                    }
             });
        });

 
       

    });
</script>
