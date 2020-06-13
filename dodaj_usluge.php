<?php require_once('../connect.php'); session_start(); if($_SESSION['rola'] == 'admin') : ?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>WORD Przemyśl</title>
<link href="../bootstrap/bootstrap.css" rel="stylesheet" >
 <link href="../bootstrap/justified-nav.css" rel="stylesheet" >
 
 
 <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap.min.css" >
            <link rel="stylesheet" href="../bootstrap/DT_bootstrap.css" >
            
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
 <div class="container">
        <div class ="masthead2">
                    <img src="../images/leftbox-logo.png" class="logo">
                    <div class="if_logged"> 
                    <?php
                    if (isset($_SESSION['login'])) {
                        echo "zalogowany jako: " . $_SESSION['login'];
                        echo "<a href='wyloguj.php'> Wyloguj</a>";
                    }
                    ?>
                    </div>
                </div>
     <div class="masthead">
                    <ul class="nav nav-justified">
                        <li><a href="../index.php">Strona główna</a></li>
                        <li><a href="index.php">Rezerwacje</a></li>
                        <li><a href="pracownicy.php">Nasze Porty</a></li>
                        <li><a href="klienci.php">Klienci</a></li>
                        <li><a href="przegladaj_zlecenia.php">Zlecenia</a></li>
                    </ul>
         </div>
</div>
<?php require_once('../connect.php'); 
$pracownicy = mysql_query("Select * from pracownicy")or die("nie pobrano pracowników");
$klienci = mysql_query("Select * from users where rola='klient'")or die("nie pobrano klienci");


?>
    <div id="rezerwacje">
<form action="dodaj.php" method="post" id="dodaj_usluge">
<input type="hidden" name="co" value="dodaj_usluge" />
<label for="id_klienta">Wybierz klienta</label>
<select name="id_klienta" id="id_klienta" />
<?php 
       while ($row = mysql_fetch_assoc($klienci)) {
           echo '<option value="'.$row['id'].'">'.$row['imie'].' '.$row['nazwisko'].'</option>';
       } 
?>
</select>
<br>
<label for="id_pracownika">Wybierz pracownika</label>
<select name="id_pracownika" id="id_pracownika" />
<?php 
       while ($row = mysql_fetch_assoc($pracownicy)) {
           echo '<option value="'.$row['id_pracownika'].'">'.$row['imie'].' '.$row['nazwisko'].'</option>';
       } 
?>
</select><br>
<label for="stan">Stan</label>
<select name="stan" id="stan" >
    <option value='1' selected="selected"> Przyjęto zlecenie </option>
</select><br>
<label for="opis">Opis:</label>
<textarea name="opis" id="opis" ></textarea></br>
<button class="btn btn-lg btn-primary btn-block" style="width: 220px;" type="submit">Dodaj zlecenie</button>
<button class="btn btn-lg btn-success" style="width: 220px;" type="reset">Wyczyść</button>

</form>
</div>
</body>
</html>
<?php else : ?> <h2 style="color:#F00">Nie masz uprawnień do przegladania tej strony !!!</h2> <?php endif; ?>