<?php
    include "connection.php";
    @session_start();
    $id = $_SESSION['id'];
    $query = mysqli_query($conn,"SELECT * FROM forum_queries WHERE id_asked_user='$id'");
    if(mysqli_num_rows($query)>0){
        $qns = array();
        while($row = mysqli_fetch_assoc($query)){
            array_push($qns,$row['id']);        
        }
        ?>
             
        <?php
       
        for($i=count($qns)-1;$i>=0;$i--){
           $innerquery = mysqli_query($conn,"SELECT * FROM forum_queries WHERE id=$qns[$i]");
           while($row = mysqli_fetch_assoc($innerquery)){
                    $date = $row['posted'];
                    $question = $row['question'];
                    $cat = $row['category'];
                    ?>
                        <p class="text-dark" style="font-size:16px"><b>Question:</b><?php echo " ".$question?></p> 
                        <p> <b>category:</b><?php echo " ".strtoupper($cat)?> </p>
                        <p><b>Posted on:</b><?php echo " ".strtoupper($date)?></p>
                        <span><button class="btn btn-danger mb-2 delbtn" id="<?php echo $qns[$i]?>">Delete</button></span>
                        <div style="width:100%;border:1px solid black;margin-bottom:4px"></div> 
       <?php
           }
           ?>
           <?php
        }
    }else{
        ?>
            <p class="text-dark text-center">You did'nt post any questions</p>
        <?php
    }
?>
<script>
    $(".delbtn").click(function(){
        let id = $(this).attr("id");
        if(confirm("Do you want to delete the posted question")){
            $.ajax({
            url:"forumdb.php?del="+id,
            type:"Get",
            success:function(resp){
                console.log(resp)
                $(".questions").load("forummyqns.php");
                $(".allquestions").load("forumaskedqns.php");
            }
        });
        }
    });
</script>