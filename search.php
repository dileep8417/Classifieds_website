<style>
     #search-field{
           position:absolute;
           width:100%;
           left:26vw;
       }
       #search-field input{
           position:relATIVE;
           top:10px;
           right:100px;
       }
       #search-btn{
       position:relative;
       top:7px;
       padding:8px;
       right:106px;
       }
</style>
 <div id="search-field">
      <input type="text" id="search-txt" placeholder="Search..." style="height:43px;width:400px;padding:10px;"> <span><button class="btn btn-success" id="search-btn">search</button></span>
       </div>
    
    <script>
        $("#search-btn").click(function(){
            let s = $("#search-txt").val();
            if(s.length>0){
                location.href = "home.php?s="+s;
            }
        });
    </script>