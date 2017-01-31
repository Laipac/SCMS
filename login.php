<!--
This module is the login page
-->
<?php include "dbConfig.php";

$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $password = $_POST["password"];
    $btntype = $_POST['submit'];
    
    if($btntype==="Reset"){
        $msg="";
    }
    else{
        if ($name == '' || $password == '') {
            $msg = "You must enter all fields";
        } else {

            $sql = $conn->prepare("SELECT pw FROM members WHERE username = ?");
            $sql->bind_param('s',$name);
            $sql->execute();

            if (!$result = $sql->get_result()) {
                echo "Could not successfully run query ($sql) from DB: " . mysqli_error($conn);

                exit;
            }

            else if (($row = mysqli_fetch_row($result)) > 0) {
                $existingHashFromDb=$row[0];

                if(password_verify($password,  $existingHashFromDb)){
                    
                    session_start();
                     $_SESSION['username'] = $name;
                     session_write_close();
                    header('Location: main.php');
                     exit();
                    mysqli_close($conn);
                   
                }
                else{
                     $msg = "Username and password do not match.";
                }
            }
            else{
                 $msg = "Username and password do not match.";
            }


        }
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login - SIM CARD Management System</title>
<meta name="description" content=""/>
<meta name="keywords" content=""/>
<link href="style.css" rel="stylesheet" type="text/css"/>
<style type="text/css">
  
</style>
</head>
<body>
    <div class="headercolor"></div>
	<form name="frmregister"action="<?= $_SERVER['PHP_SELF'] ?>" method="post" >
		<table class="form" border="0">

			<tr>
			<td></td>
				<td style="color:red;">
				<?php echo $msg; ?></td>
			</tr> 
			
			<tr>
				<th><label for="name"><strong>Username:</strong></label></th>
				<td><input class="inp-text" name="name" id="name" type="text" size="30" /></td>
			</tr>
			<tr>
				<th><label for="name"><strong>Password:</strong></label></th>
				<td><input class="inp-text" name="password" id="password" type="password" size="30" /></td>
			</tr>
			<tr>
			<td></td>
				<td class="submit-button-right">
				<input class="send_btn" type="submit" name="submit" value="Submit" alt="Submit" title="Submit" />
				
				<input class="send_btn" type="submit" name="submit" value="Reset" alt="Reset" title="Reset" /></td>
				
			</tr>
		</table>
	</form>
        
</body>
</html>
<?php 
    session_write_close();
?>