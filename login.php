 <?php
 session_start(); 
 if(isset($_POST['login']))
	 {
		 if(!empty($_POST['login']) || (!empty($_POST['haslo'])))
		 {
			 require_once('connect.php');
			 $zapytanie = 'Select * from users where login = "'.$_POST['login'].'" and haslo = "'.md5($_POST['haslo']).'"';
			 $zaloguj = mysql_query($zapytanie);
			 $row = mysql_fetch_assoc($zaloguj);
		     if($row)
			 {
                         if($row['aktywny']!='0'){
				 $_SESSION['id'] = $row['id'];
				 $_SESSION['login'] = $row['login'];
				 $_SESSION['rola'] = $row['rola']; 
				 if($_SESSION['rola']=='admin'){
				 header("Location: ../firma/admin/index.php");
				 }
				 else if($_SESSION['rola']=='klient'){
				 header("Location: ../firma/index.php");
				 }
                         }
                         else {$alert='Użytkownik nie został zweryfikowany. Potwierdzenie aktywacji wyślemy na e-mail.';}
			 }
			 else
			 {
			 	echo "Podano nie poprawne login i\lub hasło";
			 }
			
		 }
	 }
	 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title>WORD Przemyśl</title>

   
    <link href="bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/signin.css" rel="stylesheet">

    
  </head>

  <body>
<?php if(!isset($_SESSION['login'])) { ?>
    <div class="container">
        
      <form action="login.php" method="post" class="form-signin" role="form">
          <input type="hidden" name="lo" value="1">
        <h2 class="form-signin-heading">Zaloguj się</h2>
        <input type="text" class="form-control" name="login" placeholder="Email" required autofocus>
        <input type="password" class="form-control" name="haslo" placeholder="Hasło" required>
               <button class="btn btn-lg btn-primary btn-block" type="submit">Zaloguj</button>
               <button class="btn btn-lg btn-success" type="reset">Wyczyść</button>
           
      </form>
        <div id="alert_logowanie" class="alert_logowanie">
            <?php echo @$alert; ?>
        </div>

    </div> 
      <?php }

			 
	?>
  </body>
</html>
