<?php session_start(); ob_flush(); ?>
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

    <link href="bootstrap/bootstrap.css" rel="stylesheet">  
    <link href="bootstrap/justified-nav.css" rel="stylesheet">

</head>
<body>
 <div class="container">
        <div class ="masthead2">
                    <img src="images/leftbox-logo.png" class="logo">
                    <div class="if_logged">
                    <?php if(isset($_SESSION['login'])){ 
                    echo "zalogowany jako: ".$_SESSION['login'];
                    echo "<a href='wyloguj.php'> Wyloguj</a>";
                    
}?>
                    </div>
        </div>
      <div class="masthead">


        <ul class="nav nav-justified">
          <li><a href="index.php">Strona główna</a></li>
          
   <?php if(empty($_SESSION)):?> 
          <li><a href="login.php">Zaloguj</a></li> <?php endif; ?>
   <?php if(!empty($_SESSION)):?> 
          <li><a href="<?php echo $_SESSION['rola']; ?>/index.php">Przejdź do panelu</a></li> <?php endif; ?>
   <?php if(empty($_SESSION)):?> <li><a href="rejestracja.php">Zarejestruj się</a></li> <?php endif; ?>
        </ul>
      </div>   
           <!-- Jumbotron -->
      <div class="jumbotron">
        <h2>Witaj w systemie rezerwacji WORD w Przemyślu!</h2>
        <p class="lead">Aplikacja oferuje rezerwacje jazd próbnych i placu manewrowego </p>
        
      </div>

     <div id="rezerwacje" style="margin-bottom: 10px; margin-top: 30px;">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="tab">
                    <thead>
                        <tr>   
                    <td>Kategoria</td>
                    <td>Model</td>
                    <td>Nasze pojazdy</td>
                        </tr>
                        <tr>
                          <td>B</td>
                    <td>Hyundai i20</td>
                    <td><div class="row">
  <div class="col-xs-6 col-md-3">
    <a href="img/1.jpg" target="_blank" class="thumbnail">
      <img src="img/1.jpg"  alt="img/1.jpg">
    </a>
  </div></div></td>  
                        </tr>
                        <tr>
                          <td>A</td>
                    <td>Kawasaki ER - 6N</td>
                    <td><div class="row">
  <div class="col-xs-6 col-md-3">
    <a href="img/2.jpg" target="_blank" class="thumbnail">
      <img src="img/2.jpg"  alt="img/2.jpg">
    </a>
  </div></div></td>  
                        </tr>
                        <tr>
                          <td>AM</td>
                    <td>Romet Zetka</td>
                    <td><div class="row">
  <div class="col-xs-6 col-md-3">
    <a href="img/3.jpg" target="_blank" class="thumbnail">
      <img src="img/3.jpg"  alt="img/3.jpg">
    </a>
  </div></div></td>  
                        </tr>
                        <tr>
                          <td>B+E</td>
                    <td>Fiat Ducato</td>
                    <td><div class="row">
  <div class="col-xs-6 col-md-3">
    <a href="img/4.jpg" target="_blank" class="thumbnail">
      <img src="img/4.jpg"  alt="img/4.jpg">
    </a>
  </div></div></td>  
                        </tr>
                        <tr>
                          <td>C, C+E</td>
                    <td>MAN</td>
                    <td><div class="row">
  <div class="col-xs-6 col-md-3">
    <a href="img/5.jpg" target="_blank" class="thumbnail">
      <img src="img/5.jpg"  alt="img/5.jpg">
    </a>
  </div></div></td>  
                        </tr>
                        <tr>
                          <td>T</td>
                    <td>JohnDeere</td>
                    <td><div class="row">
  <div class="col-xs-6 col-md-3">
    <a href="img/6.jpg" target="_blank" class="thumbnail">
      <img src="img/6.jpg"  alt="img/6.jpg">
    </a>
  </div></div></td>  
                        </tr>
                        
                   

                    </thead>
                    <tbody>
    
                    </tbody>
                </table>
            </div>
      <div class="footer">
        <p>&copy; Krystian Matusz 2020</p>
      </div>

 </div>
  </body>
</html>
