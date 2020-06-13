<?php
require_once('connect.php');
switch ($_POST['funkcja']) {
    case 'dni':
        dni();
        break;
    case 'godziny':
        godziny();
        break;
    case 'usun_rez':
        usun_rez();
        break;
    case 'usun_pracownika':
        usun_pracownika();
        break;
    case 'usun_klienta':
        usun_klienta();
        break;
    case 'usun_dzien':
        usun_dzien();
        break;
    case 'dni_prac':
        dni_prac();
        break;
    case 'godziny_prac':
        godziny_prac();
        break;
    case 'usun_zlec':
        usun_zlec();
        break;
    case 'rozklad_pracy':
        rozklad_pracy();
        break;
        case 'aktywuj_usera':
        aktywuj_usera();
        break;
}

function dni() {
    $zapytanie = "Select * from dni_pracy where id_pracownika = '" . $_POST['id_pracownika'] . "'";
    $pracownicy = mysql_query($zapytanie) or die('Nie udalo się poberać rezerwacji');
    ?>
    <option value="dzien_none"></option>
    <?php while ($row = mysql_fetch_assoc($pracownicy)) : ?>
        <option value="<?= $row['dzien_tygodnia'] ?>"><?= $row['dzien_tygodnia'] ?></option>
    <?php endwhile; ?>
    <?php
}

function dni_prac() {
    $zapytanie = "Select * from dni_pracy where id_pracownika = '" . $_POST['id_pracownika'] . "'";
    $pracownicy = mysql_query($zapytanie) or die('Nie udalo się poberać rezerwacji');

    while ($row = mysql_fetch_assoc($pracownicy)) {

        if ($row['dzien_tygodnia'] == 'Poniedziałek') {
            echo '1_';
        }
        if ($row['dzien_tygodnia'] == 'Wtorek') {
            echo '2_';
        }
        if ($row['dzien_tygodnia'] == 'Środa') {
            echo '3_';
        }
        if ($row['dzien_tygodnia'] == 'Czwartek') {
            echo '4_';
        }
        if ($row['dzien_tygodnia'] == 'Piątek') {
            echo '5_';
        }
        if ($row['dzien_tygodnia'] == 'Sobota') {
            echo '6_';
        }
        if ($row['dzien_tygodnia'] == 'Niedziela') {
            echo '0_';
        }
    }
    // return $tab;
}

function godziny_prac() {
    if ($_POST['dzien'] == '0') {
        $dzien = 'Niedziela';
    }
    if ($_POST['dzien'] == '1') {
        $dzien = 'Poniedziałek';
    }
    if ($_POST['dzien'] == '2') {
        $dzien = 'Wtorek';
    }
    if ($_POST['dzien'] == '3') {
        $dzien = 'Środa';
    }
    if ($_POST['dzien'] == '4') {
        $dzien = 'Czwartek';
    }
    if ($_POST['dzien'] == '5') {
        $dzien = 'Piątek';
    }
    if ($_POST['dzien'] == '6') {
        $dzien = 'Sobota';
    }
    $zapytanie = "SELECT * 
FROM dni_pracy a, rezerwacje b
WHERE a.id_pracownika =  '" . $_POST['id_pracownika'] . "'
AND b.data =  '" . $_POST['data'] . "'
AND b.data = a.data_pracy
AND a.id_pracownika = b.id_pracownika";
    $pracownicy = mysql_query($zapytanie) or die('Nie udalo się poberać rezerwacji');

    while ($row = mysql_fetch_assoc($pracownicy)) {
        $godziny_od[] = $row['godzina_od'];
        $godziny_do[] = $row['godzina_do'];
        $rezerwacje[] = $row['godzina'];
    }
    $licznik = 0;
    $ile = count($rezerwacje);
    $godzina = explode(':', $godziny_od[0]);
    $godzina_do = explode(':', $godziny_do[0]);
    $roznica = ((int) $godzina_do[0] - (int) $godzina[0]) * 2;
    //echo 'godzina '.$roznica;
    $minuta = 0;
    $godzina = (int) $godzina[0];
    //print_r($rezerwacje);
    for ($i = 0; $i < $roznica; $i++) {
        if ($licznik > 1) {
            $godzina = (int) $godzina + 1;
            if ($godzina < 10) {
                $godzina = '0' . (string) $godzina;
                echo 'mniejsze';
            }

            $licznik = 0;
        }
        if ($licznik == 0) {
            $minuta = '00';
        }
        if ($licznik == 1) {
            $minuta = 30;
        }
        if (!in_array($godzina . ':' . $minuta . ':00', $rezerwacje)) {
            echo "<option value='" . $godzina . ':' . $minuta . "'>" . $godzina . ':' . $minuta . "</option>";
        }
        $licznik++;
    }

    for ($i = 0; $i < $ile; $i++) {
        // if()
    }

    // return $tab;
}
?>	

<?php

function godziny() {

    $zapytanie = "Select godzina_od,godzina_do from dni_pracy where id_pracownika = " . $_POST['id_pracownika'] . " and dzien_tygodnia = '" . $_POST['dzien'] . "' ";
    $pracownicy = mysql_query($zapytanie) or die('Nie' . $_POST['dzien']);
    ?>
    Godziny <br>
    <?php while ($row = mysql_fetch_assoc($pracownicy)) : ?>
        Od : <?php echo $row['godzina_od'] . "<br/>"; ?>
        Do : <?php echo $row['godzina_do']; ?>
    <?php endwhile; ?>
    <?php
}

function usun_rez() {
    mysql_query('Delete from rezerwacje where id_rezerwacji = "' . $_POST['id'] . '"') or die('Nie udalo się usunać');
}

function lodzie() {
    mysql_query('Select * from lodzie  = "' . $_POST['id'] . '"') or die('Nie udalo się pobrać');
}


function usun_zlec() {
    mysql_query('Delete from stan_uslug where id_zlec = "' . $_POST['id_zlec'] . '"') or die('Nie udalo się usunać zlecenia');
}


function rozklad_pracy() {
    $praca=mysql_query('select distinct * from pracownicy a, dni_pracy b where a.id_pracownika = "' . $_POST['id_pracownika'] . '" and a.id_pracownika=b.id_pracownika') or die('Nie udalo się usunać zlecenia');
    while($row = mysql_fetch_array($praca)) {
        ?> 
        <tr><td><?=$row['dzien_tygodnia']?></td><td><?=$row['godzina_od'].' - '.$row['godzina_do']?></td></tr>
            <?php
    }
    
    
}


function usun_pracownika() {
    mysql_query('Delete from pracownicy where id_pracownika = "' . $_POST['id'] . '"') or die('Nie udalo się usunać');
    mysql_query('Delete from dni_pracy where id_pracownika = ' . $_POST['id']) or die('Nie udalo się usunać');
}

function usun_klienta() {
    if (mysql_query('Delete from users where id = "' . $_POST['id'] . '"')) {
        return 1;
    } else
        return 0;
}

function usun_dzien() {
    mysql_query('Delete from dni_pracy where id = "' . $_POST['id'] . '"') or die('Nie udalo się usunać');
}


function aktywuj_usera() {
    $aktywacja=mysql_query('Update users set aktywny=1 where id = "' . $_POST['id'] . '"') or die('Nie udalo się aktywować');
    if($aktywacja){echo 'Aktywny';}
    else {echo 'Nie udało się aktywować.';}
}
?>