<?php require_once('../connect.php'); session_start(); if($_SESSION['rola'] == 'admin') :
$klienci = mysql_query("Select * from users where id = ".$_GET['user']."") or die ('Nie udalo się pobrać ');
$klient = mysql_fetch_assoc($klienci); ?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title> WORD Przemyśl</title>
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
                <div class ="if_logged">  
                    <?php
                    if (isset($_SESSION['login'])) {
                        echo "zalogowany jako: " . $_SESSION['login'];
                        echo "<a href='../wyloguj.php'> Wyloguj</a>";
                    }
                    ?>
                </div>
               <div class="masthead">
                <ul class="nav nav-justified">
        <li><a href="../index.php">Strona główna</a></li>
        <li><a href="index.php">Przeglądaj rezerwacje</a></li>
        <li><a href="pracownicy.php">Pojazdy</a></li>
        <li><a href="klienci.php">Przeglądaj klientów</a></li>
        </ul>
</div>

<div id="rezerwacje" style="margin-bottom: 10px; margin-top: 30px; margin-left: 370px; margin-right: 430px;">
<form action="edytuj.php" method="post" id="dodaj_klienta">
<input type="hidden" name="co" value="edytuj_klienta" />
<input type="hidden" name="id" id="id" value="<?=$klient['id']?>" />
<label for="imie">Imię klienta</label>
<input type="text" name="imie" id="imie" value="<?=$klient['imie']?>" /><br>
<label for="nazwisko">Nazwisko klienta</label>
<input type="text" name="nazwisko" id="nazwisko" value="<?=$klient['nazwisko']?>" /><br>
<label for="login">Email:</label>
<input type="text" name="login" id="login" value="<?=$klient['login']?>" /><br>
<a href="#" id="haslo" onClick="$('#zmien_haslo').show(); $('#haslo').hide()">zmień hasło</a>
<div id="zmien_haslo" style="display:none">
    <label for="haslo">Wpisz nowe hasło:</label>
    <input type="password" name="haslo" id="pass" /><br>
    <a href="#" id="ukryj" onClick="$('#zmien_haslo').hide(); $('#haslo').show(); $('#pass').val('')">cofnij</a>
</div><br>
<button class="btn btn-lg btn-primary btn-block" style="width: 205px;" type="submit">Zmień</button>
<button class="btn btn-lg btn-success" style="width: 205px;" type="reset">Wyczyść</button>
</form>
</div>
    <div class="footer">
        <p>&copy; Created by Krystian Matusz 2020</p>
      </div>
</body>
</html>
<?php else : ?> <h2 style="color:#F00">Nie masz uprawnień do przegladania tej strony !!!</h2> <?php endif; ?>