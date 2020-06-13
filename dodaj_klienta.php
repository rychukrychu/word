<?php require_once('../connect.php'); session_start(); if($_SESSION['rola'] == 'admin') : ?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>WORD Przemyśl</title>
<script type = "text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js" ></script>
            <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js" ></script>
            <script type = "text/javascript" src = "../bootstrap/DT_bootstrap.js"  ></script>
            <script type = "text/javascript" charset = "utf-8" language = "javascript" src = "../bootstrap/jquery.dataTables.js" ></script>
 
            <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap.min.css" >
            <link rel="stylesheet" href="../bootstrap/DT_bootstrap.css" >
            <link href="../bootstrap/bootstrap.css" rel="stylesheet" >
            <link href="../bootstrap/justified-nav.css" rel="stylesheet" >

<style type="text/css">
body {
	width:1000px;
	margin:0 auto;
}
menu li {
	display:inline;
	list-style:none;
	margin:0 15px;
}
#navi {
	text-align:center;
}
</style>
</head>
<body>
    <div class="masthead2">
               <img src="../images/leftbox-logo.png" class="logo">
                 <div class="if_logged">
                    <?php
                    if (isset($_SESSION['login'])) {
                        echo "zalogowany jako: " . $_SESSION['login'];
                        echo "<a href='../wyloguj.php'> Wyloguj</a>";
                    }
                    ?>
                </div>
    </div>
         <div class ="masthead"> 
                    <ul class="nav nav-justified">
        <li><a href="../index.php">Strona główna</a></li>
    <li><a href="index.php">Przeglądaj rezerwacje</a></li>
    <li><a href="pracownicy.php">nasze Porty</a></li>
        <li><a href="klienci.php">Przeglądaj klientów</a></li>
        </ul>
</div>

<div id="rezerwacje" style="margin-bottom: 10px; margin-top: 30px; margin-left: 370px; margin-right: 430px;">
<form action="dodaj.php" method="post" id="dodaj_klienta">
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="tab">
<input type="hidden" name="co" value="dodaj_klienta" />
<label for="imie">Imię klienta</label>
<input type="text" name="imie" id="imie" /><br>
<label for="nazwisko">Nazwisko klienta</label>
<input type="text" name="nazwisko" id="nazwisko" /><br>
<label for="login">Email:</label><br>
<input type="text" name="login" id="login" /><br>
<label for="haslo">Wpisz hasło:</label>
<input type="password" name="haslo" /><br>

<button class="btn btn-lg btn-primary btn-block" style="width: 205px;" type="submit">Dodaj</button>
<button class="btn btn-lg btn-success" style="width: 205px;" type="reset">Wyczyść</button>
</table>
</form>
</div>
    <div class="footer">
        <p>&copy; Created by Krystian Matusz 2020</p>
      </div>
</body>
</html>
<?php else : ?> <h2 style="color:#F00">Nie masz uprawnień do przegladania tej strony !!!</h2> <?php endif; ?>