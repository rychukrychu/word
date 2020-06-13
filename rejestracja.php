<?php
     	require_once('connect.php'); 
    
if(@$_POST['lo'])
{
	if(!empty($_POST['imie']) && !empty($_POST['nazwisko']) && !empty($_POST['haslo']) && !empty($_POST['email']))
	{
                $zapytanie = "select * from users where email='".$_POST['email']."'" ;
                $dodaj = mysql_query($zapytanie) or die ('Nie udalo się dodać !');
                $sprawdz = mysql_fetch_array($dodaj);
              
                if(mysql_num_rows($dodaj)>0) $alert="Użytkownik istnieje już w bazie";
                else{
		$zapytanie1 = "Insert into users(imie,nazwisko,login,haslo,rola,email) values('".$_POST['imie']."'
		,'".$_POST['nazwisko']."','".$_POST['email']."','".md5($_POST['haslo'])."','klient','".$_POST['email']."')";
		$dodaj = mysql_query($zapytanie1) or die ('Nie udalo się dodać klienta');
		if($dodaj) header("Location: index.php");
                }
        }
        else $alert="Musisz wypełnić wszystkie pola";
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
 <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script>
            $(function() {
            //$('#haslo').val('asdfasd');
            $('#haslo_powtorz').keyup(function(){
                console.log('funckja');
                var haslo_powtorz=$(this).val();
                var haslo=$('#haslo').val();
                
                if(haslo==haslo_powtorz){
                    $('#alert').html('');
                    $('#rejestruj').removeAttr('disabled');
                }
                else {
                    $('#rejestruj').attr('disabled','disabled');
                    $('#alert').html('Podane hasła są różne.');
                }
            });
        })
         </script>
    </head>
    <body>
     <?php 
     echo @$alert;
     ?>
        <div class="container">
            
        <form action="rejestracja.php" method="post">
            <input type="hidden" name="lo" value="1">
            <label for="email">Podaj email</label>
            <input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required="required"/>
            <label for="haslo">Podaj hasło</label>
            <input type="password" name="haslo" id="haslo" required="required"/><br>
            <label for="haslo_powtorz">Powtórz hasło</label>
            <input type="password" name="haslo_powtorz" id="haslo_powtorz" required="required"/><div id="alert" style="display: inline;"></div><br>
            <label for="imie">Imię</label>
            <input type="text" name="imie" id="imie" required="required"/><br>
            <label for="nazwisko">Nazwisko</label>
            <input type="text" name="nazwisko" id="nazwisko" required="required"/><br>
                <button class="btn btn-lg btn-primary btn-block" type="submit" id="rejestruj" disabled style="width: 220px; ">Rejestruj</button>
           <!--  <input type="submit" value="Rejestruj" id="rejestruj" disabled/>  -->
            <button class="btn btn-lg btn-success" type="reset" style="width: 220px; ">Wyczyść</button>
        </form>
        </div>
        

    </body>
</html>