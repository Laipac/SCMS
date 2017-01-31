<!--
checks if user is logged in.
-->
<div class="headercolor">
         <p class="greeting">
           <?php
            
                if (!(isset($_SESSION['username']))){
                     header('Location: login.php');
                   
                }
                else{
                     echo 'Hello '.$_SESSION['username'].',';
                }
           ?>
        </p>
</div> 