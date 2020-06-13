<?php require_once('../connect.php'); session_start(); if($_SESSION['rola'] == 'admin') : 
//$pracownicy = mysql_query("SELECT l.id_pracownika, imie, nazwisko, GROUP_CONCAT(dzien_tygodnia) as dzien, GROUP_CONCAT(godzina_od) as poczatek, GROUP_CONCAT(godzina_do) as koniec,GROUP_CONCAT(d.id) as id_godziny FROM pracownicy l, dni_pracy d where l.id_pracownika='".$_GET['lek']."' and d.id_pracownika = l.id_pracownika GROUP BY l.id_pracownika") or die("Nie udało się pobrać");
$pracownicy = mysql_query("select * from pracownicy where id_pracownika=".$_GET['lek']) or die("Nie udało się pobrać");
$dni_pracy = mysql_query("select * from dni_pracy where id_pracownika=".$_GET['lek']) or die("Nie udało się pobrać");

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>WORD Przemyśl </title>

 <script type = "text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js" ></script>
            <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js" ></script>
            <script type = "text/javascript" src = "../bootstrap/DT_bootstrap.js"  ></script>
            <script type = "text/javascript" charset = "utf-8" language = "javascript" src = "../bootstrap/jquery.dataTables.js" ></script>
 
            <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap.min.css" >
            <link rel="stylesheet" href="../bootstrap/DT_bootstrap.css" >
            <link href="../bootstrap/bootstrap.css" rel="stylesheet" >
            <link href="../bootstrap/justified-nav.css" rel="stylesheet" >

<link href="../bootstrap/bootstrap.css" rel="stylesheet" >
<link href="../bootstrap/justified-nav.css" rel="stylesheet" >

<script>
$(function() {
	$('.usun_godziny').click(function() {
                var id_pobierz=$(this).attr('id').split('_');
                var id=id_pobierz[1];
                
			$.ajax({
					type: "POST",
					url: "../ajax.php",
					data: { id: id,funkcja: 'usun_dzien' }
					}).done(function() {
					//$('#rezerwacje').append("Usunięto");
                                        location.reload();
				});
			//$(this).parent().remove();

	})
	$('#dodaj').click(function() {
		$('#dodane').append('<div id="dodaj"> <label for="dzien">Dzień pracy</label>'+
    '<select name="dzien[]" id="dzien">'+
        '<option value="Poniedziałek">Poniedziałek</option>'+
        '<option value="Wtorek">Wtorek</option>'+
        '<option value="Środa">Środa</option>'+
        '<option value="Czwartek">Czwartek</option>'+
        '<option value="Piątek">Piątek</option>'+
        '<option value="Sobota">Sobota</option>'+
        
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
        '<option value="19:30">19:30</option>'+
    '</select>'+
    '<label for="godzina_do">Koniec</label>'+
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
                    <ul class="nav nav-justified">
                        <li><a href="../index.php">Strona główna</a></li>
                        <li><a href="index.php">Przeglądaj rezerwacje</a></li>
                        <li><a href="pracownicy.php">Pojazdy</a></li>
                        <li><a href="klienci.php">Przeglądaj klientów</a></li>
                        
                    </ul>
</div>

<div id="rezerwacje">
<form action="/firma/admin/edytuj.php" method="post" id="dodaj_pracownika">
<input type="hidden" name="co" value="edit_prac" />
<?php 
$prac = mysql_fetch_assoc($pracownicy);



while($row = mysql_fetch_assoc($dni_pracy)) : 
$dni[]=explode(',',$row['dzien_tygodnia']); $start[]=explode(',',$row['godzina_od']); 
$end[]=explode(',',$row['godzina_do']); $id[] = explode(',',$row['id']);
endwhile;
?>
<div id="reazerwacje" style="margin-bottom: 10px; margin-top: 30px; margin-left: 300px; margin-right: 300px;">
    <table id="dodane">
        <tr>
    
        <input type="hidden" name="id" value="<?=$prac['id_pracownika'];?>" />
        <tr><td><label for="imie">Nazwa</label></td>
                <td><input type="text" name="imie" id="imie" value="<?php echo $prac['imie']; ?>" /></td>
        <tr><td><label for="nazwisko">Miasto</label></td>
            <td><input type="text" name="nazwisko" id="nazwisko" value="<?=$prac['nazwisko'];?>" /></td></tr>

<?php 
for($i=0;$i<count(@$dni);$i++) : ?>
<div id="pracy">
    <tr> <td><label for="dzien">Dzień</label></td>
    <td> <select name="dzien[]" id="dzien">
        <option value="Poniedziałek" <?php if($dni[$i][0]=='Poniedziałek') echo "selected='selected'"; ?>>Poniedziałek</option>
        <option value="Wtorek" <?php if($dni[$i][0]=='Wtorek') echo "selected='selected'"; ?>>Wtorek</option>
        <option value="Środa" <?php if($dni[$i][0]=='Środa') echo "selected='selected'"; ?>>Środa</option>
        <option value="Czwartek" <?php if($dni[$i][0]=='Czwartek') echo "selected='selected'"; ?>>Czwartek</option>
        <option value="Piątek" <?php if($dni[$i][0]=='Piątek') echo "selected='selected'"; ?>>Piątek</option>
        <option value="Sobota" <?php if($dni[$i][0]=='Sobota') echo "selected='selected'"; ?>>Sobota</option>
                </select><td></tr>
    <tr><td><label for="godzina_od">Początek </label></td>
    <td><select name="godzina_od[]" id="godzina_od">
        <option value="07:00" <?php if($start[$i][0]=='07:00:00') echo "selected='selected'"; ?>>09:00</option>
        <option value="07:30" <?php if($start[$i][0]=='07:30:00') echo "selected='selected'"; ?>>09:30</option>
    	<option value="08:00" <?php if($start[$i][0]=='08:00:00') echo "selected='selected'"; ?>>09:00</option>
        <option value="08:30" <?php if($start[$i][0]=='08:30:00') echo "selected='selected'"; ?>>09:30</option>
        <option value="09:00" <?php if($start[$i][0]=='09:00:00') echo "selected='selected'"; ?>>09:00</option>
        <option value="09:30" <?php if($start[$i][0]=='09:30:00') echo "selected='selected'"; ?>>09:30</option>
        <option value="10:00" <?php if($start[$i][0]=='10:00:00') echo "selected='selected'"; ?>>10:00</option>
        <option value="10:30" <?php if($start[$i][0]=='10:30:00') echo "selected='selected'"; ?>>10:30</option>
        <option value="11:00" <?php if($start[$i][0]=='11:00:00') echo "selected='selected'"; ?>>11:00</option>
        <option value="11:30" <?php if($start[$i][0]=='11:30:00') echo "selected='selected'"; ?>>11:30</option>
        <option value="12:00" <?php if($start[$i][0]=='12:00:00') echo "selected='selected'"; ?>>12:00</option>
        <option value="12:30" <?php if($start[$i][0]=='12:30:00') echo "selected='selected'"; ?>>12:30</option>
        <option value="13:00" <?php if($start[$i][0]=='13:00:00') echo "selected='selected'"; ?>>13:00</option>
        <option value="13:30" <?php if($start[$i][0]=='13:30:00') echo "selected='selected'"; ?>>13:30</option>
        <option value="14:00" <?php if($start[$i][0]=='14:00:00') echo "selected='selected'"; ?>>14:00</option>
        <option value="14:30" <?php if($start[$i][0]=='14:30:00') echo "selected='selected'"; ?>>14:30</option>
        <option value="15:00" <?php if($start[$i][0]=='15:00:00') echo "selected='selected'"; ?>>15:00</option>
        <option value="15:30" <?php if($start[$i][0]=='15:30:00') echo "selected='selected'"; ?>>15:30</option>
        <option value="16:00" <?php if($start[$i][0]=='16:00:00') echo "selected='selected'"; ?>>16:00</option>
        <option value="16:30" <?php if($start[$i][0]=='16:30:00') echo "selected='selected'"; ?>>16:30</option>
        <option value="17:00" <?php if($start[$i][0]=='17:00:00') echo "selected='selected'"; ?>>17:00</option>
        <option value="17:30" <?php if($start[$i][0]=='17:30:00') echo "selected='selected'"; ?>>17:30</option>
        <option value="18:00" <?php if($start[$i][0]=='18:00:00') echo "selected='selected'"; ?>>18:00</option>
        <option value="18:30" <?php if($start[$i][0]=='18:30:00') echo "selected='selected'"; ?>>18:30</option>
        <option value="19:00" <?php if($start[$i][0]=='19:00:00') echo "selected='selected'"; ?>>19:00</option>
        <option value="19:30" <?php if($start[$i][0]=='19:30:00') echo "selected='selected'"; ?>>19:30</option>
        </select></td></tr>
    <tr><td><label for="godzina_do">Koniec </label></td>
    <td><select name="godzina_do[]" id="godzina_do">
<option value="09:00" <?php if($start[$i][0]=='09:00:00') echo "selected='selected'"; ?>>09:00</option>
        <option value="07:30" <?php if($start[$i][0]=='07:30:00') echo "selected='selected'"; ?>>09:30</option>
    	<option value="08:00" <?php if($start[$i][0]=='08:00:00') echo "selected='selected'"; ?>>09:00</option>
        <option value="08:30" <?php if($start[$i][0]=='08:30:00') echo "selected='selected'"; ?>>09:30</option>
        <option value="09:30" <?php if($end[$i][0]=='09:30:00') echo "selected='selected'"; ?>>09:30</option>
        <option value="10:00" <?php if($end[$i][0]=='10:00:00') echo "selected='selected'"; ?>>10:00</option>
        <option value="10:30" <?php if($end[$i][0]=='10:30:00') echo "selected='selected'"; ?>>10:30</option>
        <option value="11:00" <?php if($end[$i][0]=='11:00:00') echo "selected='selected'"; ?>>11:00</option>
        <option value="11:30" <?php if($end[$i][0]=='11:30:00') echo "selected='selected'"; ?>>11:30</option>
        <option value="12:00" <?php if($end[$i][0]=='12:00:00') echo "selected='selected'"; ?>>12:00</option>
        <option value="12:30" <?php if($end[$i][0]=='12:30:00') echo "selected='selected'"; ?>>12:30</option>
        <option value="13:00" <?php if($end[$i][0]=='13:00:00') echo "selected='selected'"; ?>>13:00</option>
        <option value="13:30" <?php if($end[$i][0]=='13:30:00') echo "selected='selected'"; ?>>13:30</option>
        <option value="14:00" <?php if($end[$i][0]=='14:00:00') echo "selected='selected'"; ?>>14:00</option>
        <option value="14:30" <?php if($end[$i][0]=='14:30:00') echo "selected='selected'"; ?>>14:30</option>
        <option value="15:00" <?php if($end[$i][0]=='15:00:00') echo "selected='selected'"; ?>>15:00</option>
        <option value="15:30" <?php if($end[$i][0]=='15:30:00') echo "selected='selected'"; ?>>15:30</option>
        <option value="16:00" <?php if($end[$i][0]=='16:00:00') echo "selected='selected'"; ?>>16:00</option>
        <option value="16:30" <?php if($end[$i][0]=='16:30:00') echo "selected='selected'"; ?>>16:30</option>
        <option value="17:00" <?php if($end[$i][0]=='17:00:00') echo "selected='selected'"; ?>>17:00</option>
        <option value="17:30" <?php if($end[$i][0]=='17:30:00') echo "selected='selected'"; ?>>17:30</option>
        <option value="18:00" <?php if($end[$i][0]=='18:00:00') echo "selected='selected'"; ?>>18:00</option>
        <option value="18:30" <?php if($end[$i][0]=='18:30:00') echo "selected='selected'"; ?>>18:30</option>
        <option value="19:00" <?php if($end[$i][0]=='19:00:00') echo "selected='selected'"; ?>>19:00</option>
        <option value="19:30" <?php if($end[$i][0]=='19:30:00') echo "selected='selected'"; ?>>19:30</option>
        </select><td></tr>
    <tr><td><a href="#" rel="" class="usun_godziny" id="usun_<?=$id[$i][0] ?>">Usuń dzień</a></td></tr>
</div>
   <?php endfor; ?>


<tr><td><a href="#" id="dodaj">Dodaj kolejny dzień</a></td></tr>



</table>
    <table>
    <tr>
    <td><button class="btn btn-lg btn-primary btn-block" style="width: 205px;" type="submit">Zmień</button></td>
    <td><button class="btn btn-lg btn-success" style="width: 205px;" type="reset">Wyczyść</button></td>
</tr>
    </table>
</form>
</div>
    <div class="footer">
        <p>&copy; Created by Krystian Matusz 2020</p>
      </div>
</body>
</html>
<?php else : ?> <h2 style="color:#F00">Nie masz uprawnień do przegladania tej strony !!!</h2> <?php endif; ?>