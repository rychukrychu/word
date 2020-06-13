<?php require_once('../connect.php'); session_start(); if($_SESSION['rola'] == 'admin') :  ?>
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
</head>

<body>
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

        <div class ="masthead2">
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
<div class="masthead">
<ul class="nav nav-justified">
        <li><a href="../index.php">Strona główna</a></li>
    <li><a href="index.php">Przeglądaj rezerwacje</a></li>
    <li><a href="pracownicy.php">Pojazdy</a></li>
        <li><a href="klienci.php">Przeglądaj klientów</a></li>
 
    </ul>
</div>
<div id="rezerwacje">
<?php
if($_POST['co']=='edytuj_klienta')
{
	if(!empty($_POST['imie']) && !empty($_POST['nazwisko']) && !empty($_POST['login']))
	{
		require_once('../connect.php'); 
		$zapytanie = "Update users set imie = '".$_POST['imie']."',nazwisko = '".$_POST['nazwisko']."'
		,login = '".$_POST['login']."' where id = ".$_POST['id']."";
		$dodaj = mysql_query($zapytanie) or die ('Nie udalo się zminic danych');
		if(!empty($_POST['haslo']))
		{
			$zapytanie = "Update users set haslo = '".md5($_POST['haslo'])."' where id = ".$_POST['id']."";
			$dodaj = mysql_query($zapytanie) or die ('Nie udalo się zminic danych');
		}
		if($dodaj) header("Location: klienci.php");
	}
	else
	{
		echo "Nie wypełniono wszystkich pól";
	}
}

if($_POST['co']=='edit_rez')
{
	if(!empty($_POST['pracownik']) && !empty($_POST['data']) && !empty($_POST['godzina']) && !empty($_POST['klient']))
	{
		require_once('../connect.php'); 
		echo $zapytanie = "Update rezerwacje set id_pracownika = '".$_POST['pracownik']."',id_klienta = '".$_POST['klient']."'
		,data = '".$_POST['data']."',godzina = '".$_POST['godzina']."'
		where id_rezerwacji = ".$_POST['id']."";
		$dodaj = mysql_query($zapytanie) or die ('Nie udalo się zmienić rezrewacji');
		if($dodaj) header("Location: index.php");
	}
	else
	{
		echo "Nie wypełniono wszystkich pól";
	}
}
if($_POST['co']=='edit_zlec')
{
	if(!empty($_POST['pracownik']) && !empty($_POST['stan']))
	{
		require_once('../connect.php'); 
		$zapytanie = "Update stan_uslug set id_pracownika = '".$_POST['pracownik']."',stan = '".$_POST['stan']."',opis = '".$_POST['opis']."'
			where id_zlec = ".$_POST['id_zlecenia']."";
		$dodaj = mysql_query($zapytanie) or die ('Nie udalo się zmienić zlecenia');
                if($dodaj) header("Location: przegladaj_zlecenia.php"); 
                    else
                        {
                    echo "błąd"; 
                
                };
	}
	else
	{
		echo "Nie wypełniono wszystkich pól";
	}
}
if($_POST['co']=='edit_prac')
{
	if(!empty($_POST['imie']) && !empty($_POST['nazwisko']) && !empty($_POST['dzien']) && !empty($_POST['godzina_od'])
	&& !empty($_POST['godzina_do']) && !empty($_POST['dzien']) && !empty($_POST['id']))
	{
		$zapytanie = "Update pracownicy set imie = '".$_POST['imie']."',nazwisko = '".$_POST['nazwisko']."'
		where id_pracownika = ".$_POST['id']."";
		$dodaj1 = mysql_query($zapytanie);
		mysql_query("Delete from dni_pracy where id_pracownika = ".$_POST['id']."");
		$poczatek = $_POST['godzina_od'];
		$koniec = $_POST['godzina_do'];
		$kiedy = $_POST['dzien'];
		for($i=0;$i<count($poczatek);$i++)
		{
			if($poczatek[$i]<=$koniec[$i])
			{
				$zapytanie = "Insert into dni_pracy(id_pracownika, dzien_tygodnia, godzina_od, godzina_do ) values(".$_POST['id'].",'".$kiedy[$i]."','".$poczatek[$i]."'
				,'".$koniec[$i]."')";
				$dodaj2 = mysql_query($zapytanie);
			}
			else 
			{
                           
				echo "Praca nie może się kończyć zanim się zaczęła!<br>Błędne godziny nie zostały dodane do bazy!";
                                echo "<a href='edytuj_prac.php?lek=".$_POST['id']."'>Wróć</a>";
			}
		}
		if($dodaj1 && $dodaj2) header("location: http://localhost/firma/admin/pracownicy.php");
		else echo "<br>Wystąpił bląd spróbój jeszcze raz";
	}
	else
	{
		echo "Nie wypełniono wszystkich pól";
	}
}
?>
</div>
</body>
</html>
<?php else : ?> <h2 style="color:#F00">Nie masz uprawnień do przegladania tej strony !!!</h2> <?php endif; ?>