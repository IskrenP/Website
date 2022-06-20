<?php

/*
session_start();
if ( !$_SESSION['user']) {
  header('location:login.php');
}
*/

session_start();
// връзка с базата данни. В dbname се пише името на базата
// в последните два параметъра са потребителско име и парола за базата. Ако не сте ги сменяли, те са: root без парола

$connection = new PDO('mysql:host=localhost:3306;dbname=WebProject15', "root", "");
			
// ако е натиснат бутона Запиши, се изпълнява следното

if ( $_POST ) {
	
	// зареждаме каквото е въведено в полетата в отделни променливи

	$username = $_POST['username'];
	$password = $_POST['password'];
	
	
	
	// проверяваме дали са попълнени всички полета
	
	$error = "";
	$success = "";
	
	if ( ! $username ) {
		
		$error .= "Попълнете username<br>";
	}
	
	if ( ! $password ) {
		
		$error .= "Попълнете password<br>";
	}
	

	// ако всичко е попълнено се записват полетата в базата
	
	if ( !$error ) {
	
			// Заявка към базата, която записва данните за колата

			$query = $connection->prepare("
				SELECT * FROM users WHERE username = ? AND password = ?
			");
			$query->execute( [ $username, $password ] );
      $user = $query->fetch();

      if ( $user ) {
          $_SESSION['user'] = $user;
          header("location:index.html");
          alert("Успешно вписан сте !");

      } else {

        $error = "Невалидно име или парола";
      }

	}
	
	// htmlspecialchars служи да предотврятяване на грешки при въведени "специални" символи в базата..
	// Просто запомнете, че вашите полетата трябва да бъдат така направени преди да се отпечатат в сайта, за да няма проблеми с данните
	
	$username = htmlspecialchars( $username, ENT_QUOTES );
	$password = htmlspecialchars( $password, ENT_QUOTES );
}

?>






<?php
if ( $error )
{
  ?>

<h1><?= $error ?></h1>

<?php
}
?>

<form action="login.php" method="post">

<style>

  form {
    border: 3px dashed #20d052;
  }

  h1{
    text-align: center;
  }
  
p{
  text-align: center;
 font-size: 18px;
 color: rgb(255, 255, 255);
}
  /* Full-width inputs */
  input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
  }
  
  /* Set a style for all buttons */
  button {
    background-color: #040aaa;
    color: rgb(255, 255, 255);
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
  }
  
  /* Add a hover effect for buttons */
  button:hover {
    opacity: 0.8;
  }
 
  /* Add padding to containers */
  .container {
    padding: 16px;
    background-repeat: no-repeat;
    background-image: url(media/news.jpg);

  }
  
  /* The "Forgot password" text */
  span.psw {
    float: right;
    padding-top: 16px;
  }
  
  /* Change styles for span and cancel button on extra small screens */
  @media screen and (max-width: 300px) {
    span.psw {
      display: block;
      float: none;
    }
    .cancelbtn {
      width: 100%;
    }
  }
  </style>
 
  
    <div class="container">

    <h1>Седмичен бюлетин</h1>
    <p>Ако искате да получавате новини относно BSL моля впишете се</p>
  
      <label for="uname"><b>Потребителско име</b></label>
      <input type="text" placeholder="Enter Username" name="username" required>
  
      <label for="psw"><b>Парола</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
  
      <button type="submit" >Впиши се</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Запомни ме 
      </label>
    </div>
  
    <div class="container" style="background-color:#f1f1f1">
        <a href="index.html" class="previous"><i class="fas fa-chevron-left"></i> Назад</a>

     
    </div>
  </form>