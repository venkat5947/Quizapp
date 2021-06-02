



<!-- Edit Personal Questions Modal-->
<style>
.modal-body {
    max-height: calc(100vh - 200px);
    overflow-y: auto;
}
</style>

<div id="updateQueModal" class="modal fade" >
 <div class="modal-dialog">
  <form method="post" id="update_que_form" enctype="multipart/form-data">
   <div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title">EDIT QUE</h4>
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     
    </div>
    <div class="modal-body">
                
                <div class="form-group">
                    <label for="topic">Topic: </label>
                    <input type="text" class="form-control" id="topic" name='topic' required="required">
                </div>
                <div class="form-group">
                    <label for="topic">Subject: </label>
                    <input type="text" class="form-control" id="subject" name="subject">
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
                    <textarea style="height:100px;" name="discription" id="discription" class="form-control" required="required"></textarea>
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
                    <textarea style="height:100px;" name="explanation" id="explanation" class="form-control"name="explanation" required="required" ></textarea>
                </div>
    </div>
    <div class="modal-footer">
     <input type="hidden" name="qid" id="qid" />
     <input type="hidden" name="val" id="val1" />
     <!-- <input type="submit" name="update" id="update" class="btn btn-success" value="UPDATE" /> -->
     <button type="button" class="btn btn-success" name="update" id="update"  >UPDATE</button>
     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
   </div>
  </form>
 </div>
</div>

<!-- Edit Personal Questions Modal End-->

<!-- Update Profile Modal  -->

<div id="profile_modal" class="modal fade"  >
 <div class="modal-dialog">
  <form method="post" id="user_form1" enctype="multipart/form-data">
   <div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title"> Update Profile</h4>
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     
    </div>
    <div class="modal-body">
                
                <div class="form-group">
                    <label for="topic">Name: </label>
                    <input type="text" class="form-control" id="user_name1" name='user_name1' required="required">
                </div>
                <div class="form-group">
                    <label for="topic">Phone: </label>
                    <input type="text" class="form-control" id="user_phone1" name="user_phone1">
                </div>
                <div class="form-group">
                    <label for="topic">Address: </label>
                    <input type="text" class="form-control" id="user_address1" name="user_address1">
                </div>
                <div class="form-group">
                    <label for="topic">Age: </label>
                    <input type="text" class="form-control" id="user_age1" name="user_age1">
                </div>

                
                             


    

    </div>
    <div class="modal-footer">
     <input type="hidden" name="id" id="id" />
     <input type="hidden" name="val" id="val" />
     <!-- <button class="btn btn-primary" name="update_profile" id="update_profile" >Update Your Profile</button> -->
     <input   class="btn btn-success" name="update_profile" id="update_profile" value="Update Your Profile" />
     <button id="closemodal" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
   </div>
  </form>
 </div>
</div>


<!-- Update Profile Modal End -->
