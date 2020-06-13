<?php
session_start();
if ($_SESSION['rola'] == 'admin') : require_once('../connect.php');
    $tabela = '';
    $pracownicy = mysql_query("select * from pracownicy") or die('Nie udalo się pobrać listy pracownikow');
    $dni = mysql_query("select * from dni_pracy") or die('Nie udalo się pobrać listy dni');
    while ($dnii = mysql_fetch_assoc($dni)) {
        $dzien[] = array(
            'id_pracownika' => $dnii['id_pracownika'], 'dzien' => $dnii['dzien_tygodnia'], 'godzina_od' => $dnii['godzina_od'], 'godzina_do' => $dnii['godzina_do']
        );
    }

    $ile = count($dzien);

    while ($row = mysql_fetch_assoc($pracownicy)) {

        $tabela.="<tr>
            
            <td>" . $row['imie'] . "
            <td>" . $row['nazwisko'] . "</td><td>";

        for ($i = 0; $i < $ile; $i++) {
            if ($row['id_pracownika'] == $dzien[$i]['id_pracownika']) {
                $tabela.=$dzien[$i]['dzien'] . "<br>";
            }
        }
        $tabela.="</td><td>";
        for ($i = 0; $i < $ile; $i++) {
            if ($row['id_pracownika'] == $dzien[$i]['id_pracownika']) {
                $tabela.=$dzien[$i]['godzina_od'] . " - " . $dzien[$i]['godzina_do'] . "<br>";
            }
        }


        $tabela.="</td><td><a href='edytuj_prac.php?lek=" . $row['id_pracownika'] . "'>Edytuj</a>
            <a href='#' id='usun' name='" . $row['id_pracownika'] . "'>Usun</a></td>
           </tr>";

        //}
    }
    ?>
    <!DOCTYPE HTML>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <title> WORD Przemyśl </title>
            <script type = "text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js" ></script>
            <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js" ></script>
            <script type = "text/javascript" src = "../bootstrap/DT_bootstrap.js"  ></script>
            <script type = "text/javascript" charset = "utf-8" language = "javascript" src = "../bootstrap/jquery.dataTables.js" ></script>
 
            <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap.min.css" >
            <link rel="stylesheet" href="../bootstrap/DT_bootstrap.css" >
            <link href="../bootstrap/bootstrap.css" rel="stylesheet" >
            <link href="../bootstrap/justified-nav.css" rel="stylesheet" >

            <script>
                $(function() {
                    $('[id="usun"]').click(function() {
                        console.log($(this).attr('name'));
                        if (confirm('Czy jesteś pewien, że chcesz usunąć tego pracownika'))
                        {
                            
                            $.ajax({
                                type: "POST",
                                url: "../ajax.php",
                                data: {id: $(this).attr('name'), funkcja: 'usun_pracownika'}
                            }).done(function() {
                              location.reload();
                            }).fail(function() {
                                alert("Nie udało się usunąć");
                            }).success(function() {
                                        //alert("finished");
                                    });
                        }
                    });
                });
                
                $(document).ready(function() {
    $('#tab').dataTable( {
        "sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>"
    } );
    
    $.extend( $.fn.dataTableExt.oStdClasses, {
    "sWrapper": "dataTables_wrapper form-inline"
} );



} );
                
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
                
                table.table thead .sorting,
table.table thead .sorting_asc,
table.table thead .sorting_desc,
table.table thead .sorting_asc_disabled,
table.table thead .sorting_desc_disabled {
    cursor: pointer;
    *cursor: hand;
}
 
table.table thead .sorting { background: url('../images/sort_both.png') no-repeat center right; }
table.table thead .sorting_asc { background: url('../images/sort_asc.png') no-repeat center right; }
table.table thead .sorting_desc { background: url('../images/sort_desc.png') no-repeat center right; }
 
table.table thead .sorting_asc_disabled { background: url('../images/sort_asc_disabled.png') no-repeat center right; }
table.table thead .sorting_desc_disabled { background: url('../images/sort_desc_disabled.png') no-repeat center right; }

                
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
                       <div  id="rezerwacje" style="margin-bottom: 10px; margin-top: 30px;">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="tab">
                     <thead>
                         
                        <td>Pojazd</td>
                        <td>Kategoria</td>
                        <td>Dni </td>
                        <td>Godziny </td>
                        <td></td>
                    </thead>
    <?php echo $tabela; ?>
                </tbody>
                </table>
                <a href="dodaj_prac.php">Dodaj Pojazd</a>
            </div>
        </body>
    </html>
<?php else : ?> <h2 style="color:#F00">Nie masz uprawnień do przegladania tej strony !!!</h2> <?php endif; ?>