<?php
    include "connection.php";
    $query=mysqli_query($conn,"SELECT * FROM forum_queries WHERE question!='' OR question!=null");
    $arr = array();
    if(mysqli_num_rows($query)>0){
        while($row = mysqli_fetch_assoc($query)){
            array_push($arr,$row['id']);
        }
    }else{
        ?>
            <p class="text-dark text-center">No questions posted.</p>
        <?php
    }
    $months = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","sep","oct","Nov","Dec");
    for($i=count($arr)-1;$i>=0;$i--){
        $query=mysqli_query($conn,"SELECT * FROM forum_queries WHERE id=$arr[$i]");
        if(mysqli_num_rows($query)>0){
            while($row = mysqli_fetch_assoc($query)){
                    $id = $row['id']; //question id
                    $userid = $row['id_asked_user'];
                    $question = $row['question'];
                    $cat = $row['category'];
                    $date = $row['posted'];
                    //getting profile pic and name of posted user.
                    $get_user = mysqli_query($conn,"SELECT * FROM signupdb WHERE id='$userid'");
                        $user_details = mysqli_fetch_assoc($get_user);
                        $profile = $user_details['profile'];
                        if($profile==""){
                            $profile = "images/profile.jpg";
                        }
                        $user = $user_details['uname'];
                    ?>
                        <div style="padding:5px">
                        <span><img class="profile" src="<?php echo $profile?>" alt="user profile" class="img"></span><span><p><?php echo ucfirst($user)?> <b style="margin-left:10px">Posted on:</b><?php echo " ".$date?><b style="margin-left:10px">Category:</b><?php echo " ".strtoupper($cat)?></p></span>
                            <p class="text-dark" style='font-size:26px'><b>Q:<?php echo " ".$question?></b></p>
                            <span style="float:right"><a href="#" id="reply-window-<?php echo $id?>" class="reply-window">Reply</a><a style="margin-left:25px" onClick="location.href='phpSessions.php?sellerid=<?php echo $userid?>'" href="#">Personal Chat</a></span>
                        </div>

                        <!-- Reply option -->
                        <div class="card reply-window-<?php echo $id?>" style="display:none">
                            <p class="card-title text-info" style="padding:8px;margin-bottom:-4px;"><b>Reply:</b></p>
                                <span>
                                    <textarea style="width:350px;height:120px;margin-left:3px" name="" class="reply-field" id="reply-<?php echo $id?>" ></textarea>
                                    <button data-sender="<?php echo $id?>" class="btn btn-info reply-btn" style="position:relative;top:-13px;margin-left:4px">Reply</button>
                                </span>
                        </div>

                       
                    <?php
                    //getting replies
                    $inner = mysqli_query($conn,"SELECT * FROM forum_queries WHERE replied_question='$id'");
                    if(mysqli_num_rows($inner)>0){
                        ?>
                            <div class="col-md-12" style="">
                                <p class="text-info" style="font-size:22px"><b>Replies</b></p>
                            
                        <?php
                        while($r=mysqli_fetch_assoc($inner)){
                            $msg = $r['replies'];
                            $replied_user = $r['replied_user']; 
                            $date = $r['posted'];
                            $get_replied_user = mysqli_query($conn,"SELECT * FROM signupdb WHERE id='$replied_user'");
                            $details = mysqli_fetch_assoc($get_replied_user);
                            $rname = $details['uname'];
                            ?>
                                <p class="text-dark" style='font-size:26px'><b>Q:<?php echo " ".$msg?></b></p>
                                <p><b>Username:</b><?php echo ' '.ucfirst($rname)?> <b style="margin-left:10px">Posted on:</b><?php echo " ".$date?>
                            <?php
                        }
                        ?>
                            </div>
                        <?php
                    }
            }
        }
        ?>
              <div style="width:100%;border:.5px solid black;margin-bottom:4px"></div> 
        <?php
    }
?>
<script>
    $(".reply-window").click(function(e){
        e.preventDefault();
        let id = $(this).attr("id");
         $("."+id).toggle();
    });
    $(".reply-btn").click(function(){
        let txt = $(this).parent().children("textarea");
        if((txt.val()).length<3){
            alert("Enter details properly");
            txt.css("border-color","red");
        }else{
            let id = $(this).attr("data-sender");
            $.ajax({
                url:"forumdb.php",
                type:"POST",
                data:{
                    reply:id,
                    q:txt.val()
                },
                success:function(resp){
                    $(".allquestions").load("forumaskedqns.php");
                    console.log(resp);
                }
            });
            txt.css("border-color","green");
        }
    });
</script>