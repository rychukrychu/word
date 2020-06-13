<?php
session_start(); if($_SESSION['rola'] == 'admin') : 
require_once('../connect.php');
$pracownicy = mysql_query("Select s.*, u.*, p.id_pracownika, p.imie as imie_pracownika, p.nazwisko as nazwisko_pracownika   from stan_uslug s, pracownicy p, users u where s.id_zlec=".$_GET['zlec']. " and s.id_pracownika=p.id_pracownika and s.id_klienta=u.id" )  or die ('Nie udalo się pobrać zlec');
$row= mysql_fetch_array($pracownicy);


$pracownicy2 = mysql_query("Select * from pracownicy" )  or die ('Nie udalo się pobrać prac');

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>WORD Przemyśl </title>
<link rel="stylesheet" href="../css/jquery-ui-1.8.21.custom.css">
<link href="../bootstrap/bootstrap.css" rel="stylesheet" >
<link href="../bootstrap/justified-nav.css" rel="stylesheet" >

 
 
 <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap.min.css" >
            <link rel="stylesheet" href="../bootstrap/DT_bootstrap.css" >

<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap.min.css" >
<script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js" ></script>
<script src="http://jquery-ui.googlecode.com/svn/trunk/ui/i18n/jquery.ui.datepicker-pl.js"></script>
<script src="../js/jquery.ui.core.js"></script>
<script src="../js/jquery.ui.widget.js"></script>
<script src="../js/datapicker.js"></script>
<script>
$(function() {
	$.ajax({
  			type: "POST",
  			url: "../ajax.php",
  			data: { id_pracownika: $('#pracownik').val(),funkcja: 'dni' }
			}).done(function(data) {
  			$('#praca').html(data);
		});
	$('#pracownik').change(function() {
		$.ajax({
  			type: "POST",
  			url: "../ajax.php",
  			data: { id_pracownika: $(this).val(),funkcja: 'dni' }
			}).done(function(data) {
  			$('#praca').html(data);
		});
	})
	$("#data").datepicker({	dateFormat: "yy-mm-dd" });
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
                        echo "<a href='../wyloguj.php'> Wyloguj</a>";
                    }
                    ?>
                </div>
                 </div>
    <div class="masthead">
    <ul class="nav nav-justified">
    <li><a href="../index.php">Strona główna</a></li>
    <li><a href="index.php">Rezerwacje</a></li>
    <li><a href="pracownicy.php">Pojazdy</a></li>
        <li><a href="klienci.php">Klienci</a></li> 
    <li><a href="przegladaj_zlecenia.php">Zlecenia</a></li>
    </ul>
</div>

<div id="rezerwacje" style="margin-left: 370px;">
Edycja zlecenia: <?=$row['imie'].' '.$row['nazwisko']?>

<form action="edytuj.php" method="post">
    <table>
 <tr>
            <input type='hidden' name="id_zlecenia" value='<?php echo $row['id_zlec'];?>' />
            <input type='hidden' name="co" value='edit_zlec' />
            <td><select name='pracownik'>
                <?php 
 while ($row1 = mysql_fetch_array($pracownicy2)) {
     if($row1['id_pracownika']==$row['id_pracownika']){echo '<option value="'.$row1['id_pracownika'].'" selected="selected">'.$row1['imie'].' '.$row1['nazwisko'].'</option>';}
     else echo '<option value="'.$row1['id_pracownika'].'">'.$row1['imie'].' '.$row1['nazwisko'].'</option>';
 }
                ?>
                </select>
            </td></tr>
            
            <tr><td><select name='stan'>
                    <option value='1' <?php echo $row['stan']=='1'? 'selected="selected"':''; ?>>Przyjęto zlecenie</option>
                    <option value='2' <?php echo $row['stan']=='2'? 'selected="selected"':''; ?>>Zlecenie w trakcie realizacji</option>
                    <option value='3' <?php echo $row['stan']=='3'? 'selected="selected"':''; ?>>Zakończono realizację usługi. Do odbioru.</option>
                </select>
                </td></tr>
<td><textarea name="opis"><?php echo $row['opis'];?></textarea></td>

        </tr>
        <tr><td><button class="btn btn-lg btn-primary btn-block" style="width: 220px;" type="submit">Zapisz</button></td></tr>
    </table>
</form>
</div>
</body>
</html>
<?php else : ?> <h2 style="color:#F00">Nie masz uprawnień do przegladania tej strony !!!</h2> <?php endif; ?>