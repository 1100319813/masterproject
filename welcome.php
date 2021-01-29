<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $topic = $content = "";
$name_err = $topic_err = $content_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate name
    if(empty(trim($_POST["name"]))){
        $name_err = "введите имя";
    } 
    
    // Validate topic
    if(empty(trim($_POST["topic"]))){
        $topic_err = "введите тему.";     
    } 
	
	// Validate content
    if(empty(trim($_POST["content"]))){
        $content_err = "введите подробности.";     
    }
    
	$name = $_POST["name"];
    $topic = $_POST["topic"];
	$content = $_POST["content"];
	
    // Check input errors before inserting in database
    if(empty($name_err) && empty($topic_err) && empty($content_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO posts (name, topic, content) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_topic, $param_content);
            
            // Set parameters
            $param_name = $name;
			$param_topic = $topic;
			$param_content = $content;
            
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: posts.php");
            } else{
                echo "Что-то пошло не так";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
	
	/*
    
	$sql = "SELECT * FROM posts";

	$result = mysqli_query($link, $sql);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			echo "<div class='wrapper'>"; 
			echo "<div class='form-group'"; 
			echo "<label>" . $row[$name] . "</label><h5>" . $row[$topic] . "</h5><label>" . $row[$content] . "</label>";
			echo "</div>";
			echo "</div>";
			echo "<br><br>";
		}
	} else {
		echo "0 results";
	}

	mysqli_close($conn);

	
	

	$query = "SELECT * FROM posts"; 
	$result = mysql_query($query);
	

	while($row = mysql_fetch_array($result)){   //Creates a loop to loop through results
	echo "<div class='wrapper'>"; 
	echo "<div class='form-group'"; 
	echo "<label>" . $row[$name] . "</label><h5>" . $row[$topic] . "</h5><label>" . $row[$content] . "</label>";  
	echo "</div>";
	echo "</div>";
	echo "<br><br>";
	}
*/
	// Close connection
	mysqli_close($link);
	mysql_close(); 
    
    
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forum</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
		ul {
		  list-style-type: none;
		  margin: 0;
		  padding: 0;
		  overflow: hidden;
		  background-color: #333;
		}

		li {
		  float: left;
		  border-right:1px solid #bbb;
		}

		li:last-child {
		  border-right: none;
		}

		li a {
		  display: block;
		  color: white;
		  text-align: center;
		  padding: 14px 16px;
		  text-decoration: none;
		}

		li a:hover:not(.active) {
		  background-color: #111;
		}

		.active {
		  background-color: #4CAF50;
		}
		</style>

</head>
<ul>
  <ul>
  <li><a class="active" href="login.php">Вход</a></li>
  <li><a href="register.php">Регистрация</a></li>
  <li><a href="logout.php">Выход</a></li>
  <li><a href="reset-password.php">Сброс пароля</a></li>
  <li style="float:right"><a href="welcome.php">Написать пост</a></li>
  <li style="float:right"><a href="posts.php">Форум</a></li>
</ul>
</ul>
</head>
<body>
    <div class="wrapper">
		
        <h2>Форум Школьников</h2>
        <p>Напишите о чем-нибудь интересном в форуме</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Имя</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                <span class="help-block"><?php echo $topic_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Тема</label>
                <input type="text" name="topic" class="form-control" value="<?php echo $topic; ?>">
                <span class="help-block"><?php echo $topic_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Подробности</label>
                <input type="text" name="content" class="form-control" value="<?php echo $content; ?>">
                <span class="help-block"><?php echo $content_err; ?></span>
            </div>
            
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Выложить">
                
            </div>
            
        </form>
    </div>    
</body>
</html>







