<?php require_once('../connect.php'); session_start(); if($_SESSION['rola'] == 'admin') : 
$pracownicy = mysql_query('Select id_pracownika from pracownicy group by id_pracownika desc limit 1');
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>WORD Przemyśl</title>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/jquery-ui-1.8.21.custom.css">
<link href="../bootstrap/bootstrap.css" rel="stylesheet" >
 <link href="../bootstrap/justified-nav.css" rel="stylesheet" >
 
            <script type = "text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js" ></script>
            <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js" ></script>
            <script type = "text/javascript" src = "../bootstrap/DT_bootstrap.js"  ></script>
            <script type = "text/javascript" charset = "utf-8" language = "javascript" src = "../bootstrap/jquery.dataTables.js" ></script>
 
            <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap.min.css" >
            <link rel="stylesheet" href="../bootstrap/DT_bootstrap.css" >
            
<link href="../bootstrap/bootstrap.css" rel="stylesheet" >
<link href="../bootstrap/justified-nav.css" rel="stylesheet" >
<script src="../js/jquery.ui.core.js"></script>
<script src="../js/jquery.ui.widget.js"></script>
<script src="../js/datapicker.js"></script>
<script>
$(function() {
    
    $("#data").datepicker({	dateFormat: "yy-mm-dd" });
    
	$('[id="usun"]').click(function() {
		alert('sss');
		});
	$('#dodaj').click(function() {
		$('#dodane').append('<div id="dodaj"> <label for="dzien">Dzień pracy</label>'+
    '<select name="dzien[]" id="dzien">'+
        '<option value="Poniedziałek">Poniedziałek</option>'+
        '<option value="Wtorek">Wtorek</option>'+
        '<option value="Środa">Środa</option>'+
        '<option value="Czwartek">Czwartek</option>'+
        '<option value="Piątek">Piątek</option>'+
        '<option value="Sobota">Sobota</option>'+
        '<option value="Niedziela">Niedziela</option>'+
    '</select>'+
    '<label for="godzina_od">Początek </label>'+
    '<select name="godzina_od[]" id="godzina_od">'+
        '<option value="07:00">07:00</option>'+
        '<option value="07:30">07:30</option>'+
        '<option value="08:00">08:00</option>'+
        '<option value="08:30">08:30</option>'+
    	'<option value="09:00">09:00</option>'+
        '<option value="09:30">09:30</option>'+
        '<option value="10:00">10:00</option>'+
        '<option value="10:30">10:30</option>'+
        '<option value="11:00">11:00</option>'+
        '<option value="11:30">11:30</option>'+
        '<option value="12:00">12:00</option>'+
        '<option value="12:30">12:30</option>'+
        '<option value="13:00">13:00</option>'+
        '<option value="13:30">13:30</option>'+
        '<option value="14:00">14:00</option>'+
        '<option value="14:30">14:30</option>'+
        '<option value="15:00">15:00</option>'+
        '<option value="15:30">15:30</option>'+
        '<option value="16:00">16:00</option>'+
        '<option value="16:30">16:30</option>'+
        '<option value="17:00">17:00</option>'+
        '<option value="17:30">17:30</option>'+
        '<option value="18:00">18:00</option>'+
        '<option value="18:30">18:30</option>'+
        '<option value="19:00">19:00</option>'+
        
    '</select>'+
    '<label for="godzina_do">Koniec </label>'+
    '<select name="godzina_do[]" id="godzina_do">'+
        '<option value="07:30">07:30</option>'+
        '<option value="08:00">08:00</option>'+
        '<option value="08:30">08:30</option>'+
    	'<option value="09:00">09:00</option>'+
        '<option value="09:30">09:30</option>'+
        '<option value="10:00">10:00</option>'+
        '<option value="10:30">10:30</option>'+
        '<option value="11:00">11:00</option>'+
        '<option value="11:30">11:30</option>'+
        '<option value="12:00">12:00</option>'+
        '<option value="12:30">12:30</option>'+
        '<option value="13:00">13:00</option>'+
        '<option value="13:30">13:30</option>'+
        '<option value="14:00">14:00</option>'+
        '<option value="14:30">14:30</option>'+
        '<option value="15:00">15:00</option>'+
        '<option value="15:30">15:30</option>'+
        '<option value="16:00">16:00</option>'+
        '<option value="16:30">16:30</option>'+
        '<option value="17:00">17:00</option>'+
        '<option value="17:30">17:30</option>'+
        '<option value="18:00">18:00</option>'+
        '<option value="18:30">18:30</option>'+
        '<option value="19:00">19:00</option>'+
        '<option value="19:30">19:30</option>'+
    '</select>'
		+'<a href="#" onClick="$(this).parent().remove()">Usun</a><br/></div>');
		});
})
</script>
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
                        echo "<a href='wyloguj.php'> Wyloguj</a>";
                    }
                    ?>
                </div>
                </div>
    <div class="masthead">
                    <ul class="nav nav-justified">
        <li><a href="../index.php">Strona główna</a></li>
        <li><a href="index.php">Przeglądaj rezerwacje</a></li>
        <li><a href="pracownicy.php">Pojazdy</a></li>
        <li><a href="klienci.php">Przeglądaj klientów</a></li>
    
    </ul>
</div>

<div id="rezerwacje"  style="margin-bottom: 10px; margin-top: 30px; margin-left: 300px; margin-right: 300px;">
    <table id="dodane">
        
<form action="dodaj.php" method="post" id="dodaj_pracownika">
<input type="hidden" name="co" value="prac" />
<?php foreach(mysql_fetch_assoc($pracownicy) as $id) ?>
<input type="hidden" name="id" value="<?=$id+1?>" />
<tr><td><label for="imie">Pojazd</label></td>
<td><input type="text" name="imie" id="imie" /></td></tr>
<tr><td><label for="nazwisko">Kategoria</label></td>
<td><input type="text" name="nazwisko" id="nazwisko" /></td></tr>

<div id="przyjecia">
    <label for="dzien">Dzień pracy</label>
    <select name="dzien[]" id="dzien">
        <option value="Poniedziałek">Poniedziałek</option>
        <option value="Wtorek">Wtorek</option>
        <option value="Środa">Środa</option>
        <option value="Czwartek">Czwartek</option>
        <option value="Piątek">Piątek</option>
        <option value="Sobota">Sobota</option>
       
    </select>
    <label for="godzina_od">Początek </label>
    <select name="godzina_od[]" id="godzina_od">
    	<option value="07:00">07:00</option>
        <option value="07:30">07:30</option>
        <option value="08:00">08:00</option>
        <option value="08:30">08:30</option>
        <option value="09:00">09:00</option>
        <option value="09:30">09:30</option>
        <option value="10:00">10:00</option>
        <option value="10:30">10:30</option>
        <option value="11:00">11:00</option>
        <option value="11:30">11:30</option>
        <option value="12:00">12:00</option>
        <option value="12:30">12:30</option>
        <option value="13:00">13:00</option>
        <option value="13:30">13:30</option>
        <option value="14:00">14:00</option>
        <option value="14:30">14:30</option>
        <option value="15:00">15:00</option>
        <option value="15:30">15:30</option>
        <option value="16:00">16:00</option>
        <option value="16:30">16:30</option>
        <option value="17:00">17:00</option>
        <option value="17:30">17:30</option>
        <option value="18:00">18:00</option>
        <option value="18:30">18:30</option>
        <option value="19:00">19:00</option>
        <option value="19:30">19:30</option>
        <option value="20:00">20:00</option>
        <option value="20:30">20:30</option>
        <option value="21:00">20:30</option>
        <option value="21:30">21:30</option>
        <option value="22:00">22:00</option>
    </select>
    <label for="godzina_do">Koniec </label>
    <select name="godzina_do[]" id="godzina_do">
    	<option value="07:30">07:30</option>
        <option value="08:00">08:00</option>
        <option value="08:30">08:30</option>
        <option value="09:00">09:00</option>
        <option value="09:30">09:30</option>
        <option value="10:00">10:00</option>
        <option value="10:30">10:30</option>
        <option value="11:00">11:00</option>
        <option value="11:30">11:30</option>
        <option value="12:00">12:00</option>
        <option value="12:30">12:30</option>
        <option value="13:00">13:00</option>
        <option value="13:30">13:30</option>
        <option value="14:00">14:00</option>
        <option value="14:30">14:30</option>
        <option value="15:00">15:00</option>
        <option value="15:30">15:30</option>
        <option value="16:00">16:00</option>
        <option value="16:30">16:30</option>
        <option value="17:00">17:00</option>
        <option value="17:30">17:30</option>
        <option value="18:00">18:00</option>
        <option value="18:30">18:30</option>
        <option value="19:00">19:00</option>
        <option value="19:30">19:30</option>
        
    </select>
</div>
<div id="dodane"></div>
<a href="#" id="dodaj">Dodaj dzień</a>
<input type="submit" value="Dodaj" />
<input type="reset" value="Wyczysc" />
<table>
    <tr>
    <td><button class="btn btn-lg btn-primary btn-block" style="width: 205px;" type="submit">Zapisz</button></td>
    <td><button class="btn btn-lg btn-success" style="width: 205px;" type="reset">Wyczyść</button></td>
</tr>
    </table>
</form>
</div>
</body>
</html>
<?php else : ?> <h2 style="color:#F00">Nie masz uprawnień do przegladania tej strony !!!</h2> <?php endif; ?>