<?php require_once('../connect.php'); session_start(); if($_SESSION['rola'] == 'admin') :  ?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>WORD Przemyśl</title>
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
<div id="navi">
    <menu>
        <li><a href="../index.php">Strona główna</a></li>
    <li><a href="index.php">Rezerwacje</a></li>
    <li><a href="pracownicy.php">Pojazdy </a></li>
    <li><a href="dodaj_rez.php">Dodaj rezerwacje</a></li>
    </menu>
</div>
<div id="rezerwacje">
<?php 		require_once('../connect.php'); 
 if(isset($_SESSION['login'])): echo "zalogowany jako: ".$_SESSION['login']; echo "<a href='../wyloguj.php'>Wyloguj</a>"; endif; 
if($_POST['co']=='dodaj_klienta')
{
	if(!empty($_POST['imie']) && !empty($_POST['nazwisko']) && !empty($_POST['login']) && !empty($_POST['haslo']))
	{
		$zapytanie = "Insert into users(imie,nazwisko,login,haslo) values('".$_POST['imie']."'
		,'".$_POST['nazwisko']."','".$_POST['login']."','".sha1($_POST['haslo'])."')";
		$dodaj = mysql_query($zapytanie) or die ('Nie udalo się dodać klienta');
		if($dodaj) header("Location: klienci.php");
	}
	else
	{
		echo "Nie wypełniono wszystkich pól";
	}
}
if($_POST['co']=='rez')
{
	if(!empty($_POST['pracownik']) && !empty($_POST['data']) && !empty($_POST['godzina']) && !empty($_POST['klient']))
	{
		$godzina=explode(':',$_POST['godziny']);
            if((int)$godzina[0]<10){$godziny='0'.(string)$godzina[0];}
            $czas=$godziny.':'.$godzina[1].':00';
	//echo $_POST['pracownik'].' 	'.$_POST['data'].' '.$_POST['godziny'].' '.$_SESSION['id'];
		$zapytanie = "Insert into rezerwacje(id_pracownika,data,godzina,id_klienta) values(".$_POST['pracownik']."
		,'".$_POST['data']."','".$czas."',".$_SESSION['id'].")";
		$dodaj = mysql_query($zapytanie) or die ('Nie udalo się dodać rezrewacji');
		//if($dodaj) header("Location: index.php");
	}
	else
	{
		echo "Nie wypełniono wszystkich pól";
	}
}
if($_POST['co']=='dodaj_usluge')
    {
    if(!empty($_POST['id_klienta']) && !empty($_POST['id_pracownika']) && !empty($_POST['stan']) && !empty($_POST['opis']))
    {
        
        $zapytanie = "Insert into stan_uslug(id_klienta,id_pracownika,stan,opis,data_przyjecia) values(".$_POST['id_klienta'].",'".$_POST['id_pracownika']."','".$_POST['stan']."','".$_POST['opis']."','".date('Y-m-d')."')";
        $dodaj = mysql_query($zapytanie) or die ('Nie udalo się dodać rezrewacji');
        if($dodaj) header("Location: index.php");
        else {
            header("Location: dodaj_usluge.php");
            
        }
    }
    else echo 'uzupełnij';
    
    
    }
    
    
    if($_POST['co']=='admin_dodaj_rez')
    {
    if(!empty($_POST['klient']) && !empty($_POST['pracownik']) && !empty($_POST['data']) && !empty($_POST['godziny']))
    {
            $godzina=explode(':',$_POST['godziny']);
            if((int)$godzina[0]<10){$godziny='0'.(string)$godzina[0];}
            else {$godziny=$godzina[0];}
            $czas=$godziny.':'.$godzina[1].':00';
            //echo $czas;
        $zapytanie = "Insert into rezerwacje(id_pracownika,id_klienta,data,godzina, data_dodania) values(".$_POST['pracownik'].",'".$_POST['klient']."','".$_POST['data']."','".$czas."','".date('Y-m-d H:i:s')."')";
        $dodaj = mysql_query($zapytanie) or die ('Nie udalo się dodać rezrewacji');
        if($dodaj) header("Location: index.php");
        else {
            header("Location: dodaj_rez.php");
            
        }
    }
    else echo 'uzupełnij';
    
    
    }
    
if($_POST['co']=='prac')
{
	if(!empty($_POST['imie']) && !empty($_POST['nazwisko']) && !empty($_POST['dzien']) && !empty($_POST['godzina_od'])
	&& !empty($_POST['godzina_do']) && !empty($_POST['dzien']) && !empty($_POST['id']))
	{
		$zapytanie = "Insert into pracownicy values('".$_POST['id']."','".$_POST['imie']."','".$_POST['nazwisko']."')";
		$dodaj1 = mysql_query($zapytanie);
		$poczatek = array();
		$koniec = array();
		$kiedy = array();
		foreach($_POST['godzina_od'] as $start)
		array_push($poczatek,$start);
		foreach($_POST['godzina_do'] as $end)
		array_push($koniec,$end);
		foreach($_POST['dzien'] as $dzien)
		array_push($kiedy,$dzien);
		for($i=0;$i<count($poczatek);$i++)
		{
			if($poczatek[$i]<$koniec[$i])
			{
				$zapytanie = "Insert into dni_pracy values('".$_POST['id']."','".$kiedy[$i]."','".$poczatek[$i]."'
				,'".$koniec[$i]."')";
				$dodaj2 = mysql_query($zapytanie);
			}
			else 
			{
				echo "Wybrano złe godziny pracy";
			}
		}
		if($dodaj1 && $dodaj2) echo "Dodano pozytywnie";
		else echo "Wystąpił bląd spróbój jeszcze raz";
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