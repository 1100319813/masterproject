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
  <li><a class="active" href="login.php">Вход</a></li>
  <li><a href="register.php">Регистрация</a></li>
  <li><a href="logout.php">Выход</a></li>
  <li><a href="reset-password.php">Сброс пароля</a></li>
  <li style="float:right"><a href="welcome.php">Написать пост</a></li>
  <li style="float:right"><a href="posts.php">Форум</a></li>
</ul>
</head>
<h2>Форум Школьников</h2>
<body>
    <div class="wrapper">

<?php

// Include config file
require_once "config.php";

$sql = "SELECT * FROM posts";

	$result = mysqli_query($link, $sql);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			echo "<div class='wrapper'>"; 
			echo "<div class='form-group'"; 
			echo "<h3> Автор: " . $row['name'] . "</h3><h3> Тема: " . $row['topic'] . "</h3><label>" . $row['content'] . "</label>";
			echo "</div>";
			echo "</div>";
			echo "<br>";
		}
	} else {
		echo "0 results";
	}

	//mysqli_close($conn);
?>


		
        
    </div>    
</body>
</html>