<?php
session_start(); if($_SESSION['rola'] == 'admin') : 
require_once('../connect.php');
$pracownicy = mysql_query("Select * from pracownicy") or die ('Nie udalo się pobrać pracowników') or die ('Nie udalo się pobrać pracowników');
$klienci = mysql_query("Select id,imie,nazwisko from users where rola = 'klient'") or die ('Nie udalo się pobrać klientów');
$rezerwacja = mysql_query("Select * from rezerwacje a, users b where a.id_rezerwacji  = ".$_GET['rez']." and a.id_klienta=b.id")
or die ('Nie udalo się pobrać rezerwacji'); $rez = mysql_fetch_assoc($rezerwacja);
?>
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
<link rel="stylesheet" href="../css/jquery-ui-1.8.21.custom.css">
<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script src="http://jquery-ui.googlecode.com/svn/trunk/ui/i18n/jquery.ui.datepicker-pl.js"></script>
<script src="../js/jquery.ui.core.js"></script>
<script src="../js/jquery.ui.widget.js"></script>
<script src="../js/datapicker.js"></script>
<script>
$( document ).ready(
$(function() {

    	$.ajax({
  			
                                type: "POST",
                                url: "../ajax.php",
                                data: {id_pracownika: $('#pracownik').val(), funkcja: 'dni_prac'}
                            }).done(function(data) {
                                dni = data;
                                data_function(dni);
                         
		});
                        

                        var data1=$('#data').val();
                        var data = new Date(data1);
                        var rok = data.getFullYear();
                        var mies = data.getMonth();
                        if(data.getMonth()<9){mies2=data.getMonth()+1; mies2='0'+mies2;} else {mies2=data.getMonth()+1} 
                        var dzien = data.getDay();
                        if(data.getDate()<9){dzien2=data.getDate(); dzien2='0'+dzien2;} else {dzien2=data.getDate()} 
                        var datka=data.getFullYear()+'-'+mies2+'-'+dzien2;
                        $('#data').val(datka);
                        console.log(datka);
                        
                        console.log(dzien);
                        console.log($('#pracownik').val());
                        $.ajax({
                            type: "POST",
                            url: "../ajax.php",
                            data: {id_pracownika: $('#pracownik').val(), dzien: dzien, data: datka, funkcja: 'godziny_prac'}
                        }).done(function(data) {
                            console.log(data);
                            $('#godziny').append(data);
                           // $('#godziny').append('<option></option>');
                        });
                
                
                    var dni1;
                    var dni;
                    $('#pracownik').change(function() {
                        if ($(this).val() == 'none') {
                            $('#praca').css('display', 'none');
                            $('#godziny').css('display', 'none');
                        }
                        else {
                            $('#praca').css('display', 'block');

                            $.ajax({
                                type: "POST",
                                url: "../ajax.php",
                                data: {id_pracownika: $(this).val(), funkcja: 'dni_prac'}
                            }).done(function(data) {
                                dni = data;
                                data_function(dni);
                            });
                        }

                    });


                    function data_function(dni) {

                     
                        $("#data").datepicker("destroy");
                        $("#data").datepicker(
                                {beforeShowDay: function(day) {

                                        var day = day.getDay();

                                        if (dni.indexOf(day) == -1) {
                                            return [false, "somecssclass"]
                                        } else {
                                            return [true, "someothercssclass"]
                                        }


                                    }
                                });
                        $("#data").datepicker("refresh");

                    };

                    //$("#data").datepicker();


                    $('#data').change(function() {
                        var data1=$(this).val();
                        var data = new Date(data1);
                        var rok = data.getFullYear();
                        var mies = data.getMonth();
                        if(data.getMonth()<9){mies2=data.getMonth()+1; mies2='0'+mies2;} else {mies2=data.getMonth()+1} 
                        var dzien = data.getDay();
                        if(data.getDate()<9){dzien2=data.getDate(); dzien2='0'+dzien2;} else {dzien2=data.getDate()} 
                        var datka=data.getFullYear()+'-'+mies2+'-'+dzien2;
                        $('#data').val(datka);
                        console.log(datka);
                        
                        console.log(dzien);
                        $.ajax({
                            type: "POST",
                            url: "../ajax.php",
                            data: {id_pracownika: $('#pracownik').val(), dzien: dzien, data: datka, funkcja: 'godziny_prac'}
                        }).done(function(data) {
                            $('#godziny').html('');
                            $('#godziny').append(data);
                           // $('#godziny').append('<option></option>');
                        });
                    });




                    $('#dzien').change(function() {
                        if ($(this).val() == 'dzien_none') {
                            $('#godziny').css('display', 'none');
                        }
                        else {
                            $('#godziny').css('display', 'block');
                            $.ajax({
                                type: "POST",
                                url: "../ajax.php",
                                data: {id_pracownika: $('#pracownik').val(), dzien: $(this).val(), funkcja: 'godziny'}
                            }).done(function(data) {
                                $('#godziny').html(data);
                            });
                        }
                    });
                }) );

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
    <li><a href="index.php">Przeglądaj rezerwacje</a></li>
    <li><a href="pracownicy.php">Pojazdy</a></li>
    <li><a href="klienci.php">Przeglądaj klientów</a></li>
    <li><a href="przegladaj_zlecenia.php">Zlecenia</a></li>
    
    </ul>
</div>

<div id="rezerwacje" style="margin-bottom: 10px; margin-top: 30px; margin-left: 370px; margin-right: 430px;">
Edycja rezerwacji: <?=$rez['imie'].' '.$rez['nazwisko']?>

<form action="edytuj.php" method="post">
<input type="hidden" name="id" value="<?=$_GET['rez']?>" />
<input type="hidden" name="co" value="edit_rez" />
<label for="pracownik">Wybierz Pojazd</label>
<select id="pracownik" name="pracownik">
<?php while($row = mysql_fetch_assoc($pracownicy)) : ?>
    <?php if ($row['id_pracownika'] == $rez['id_pracownika']) {echo "<option value='".$row['id_pracownika']."' selected='selected'>".$row['imie'].' '.$row['nazwisko']."</option>"; } 
    else { ?>
 <option value="<?=$row['id_pracownika']?>"><?= $row['imie'].' '.$row['nazwisko']?></option>    
 <?php }?>

<?php endwhile; ?>
</select>

<label for="data">Wybierz date</label>
<input type="text" name="data" id="data" value="<?php echo $rez['data']; ?>" /><br>
<label for="data">Wybierz godzinę</label>
<select id="godziny" name="godziny" value="<?php echo $rez['godziny']; ?>" />
                        
                    </select><br>
 
                    

<button class="btn btn-lg btn-primary btn-block" style="width: 205px;" type="submit">Zmień</button>

</form>
</div>
    <div class="footer">
        <p>&copy; Created by Krystian Matusz 2020</p>
      </div>
</body>
</html>
<?php else : ?> <h2 style="color:#F00">Nie masz uprawnień do przegladania tej strony !!!</h2> <?php endif; ?>