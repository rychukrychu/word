<?php
session_start();
ob_flush();
if (empty($_SESSION))
    header("Location: ../login.php");
if ($_SESSION['rola'] == 'klient') {
    require_once('../connect.php');
    $stan = mysql_query("Select id_rezerwacji, marka, model, l.imie as imie_pracownika,l.nazwisko as nazwisko_pracownika,data,godzina,opis,data_dodania
,u.imie,u.nazwisko from pracownicy l,rezerwacje r,users u where l.id_pracownika = r.id_pracownika and u.id = id_klienta
and id_klienta = " . $_SESSION['id'] . "") or die('Nie udalo się pobrać rezerwacji');
    ?>
    <!DOCTYPE HTML>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
            <title>WORD Przemyśl</title>

            <script type = "text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js" ></script>
             <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js" ></script>
            <script type = "text/javascript" src = "../bootstrap/DT_bootstrap.js"  ></script>
            <script type = "text/javascript" charset = "utf-8" language = "javascript" src = "../bootstrap/jquery.dataTables.js" ></script>
 
            <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap.min.css" >
            <link rel="stylesheet" href="../bootstrap/DT_bootstrap.css" >
            <link href="../bootstrap/bootstrap.css" rel="stylesheet" >
            <link href="../bootstrap/justified-nav.css" rel="stylesheet" >


            <script type="text/javascript">
              $(document).ready(function() {
                    $('#tab').dataTable({
                        "sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>"
                    });

                    $.extend($.fn.dataTableExt.oStdClasses, {
                        "sWrapper": "dataTables_wrapper form-inline"
                    });



                });

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
            <div class="container">
                <div class="masthead2">
               <img src="../images/leftbox-logo.png" class="logo">
                  <div class="if_logged">
                    <?php
                    if (isset($_SESSION['login'])) {
                        echo "zalogowany jako: " . $_SESSION['login'];
                        
                    }
                    ?>
                  </div>
                </div>
               <div class="masthead">
                <ul class="nav nav-justified">
                    <li><a href="../index.php">Strona główna</a></li>

                    <li><a href="index.php">Przeglądaj rezerwacje</a></li>
                    <li><a href="dodaj_rez.php">Dodaj rezerwację</a></li>
                    
                    <li><a href='../wyloguj.php'> Wyloguj</a></li>
                </ul>
            </div> 
            <div id="rezerwacje" style="margin-bottom: 10px; margin-top: 30px;">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="tab">
                    <thead>
                    <td>Pojazd i Kategoria</td>
                    
                    <td>Data rezerwacji</td>
                    <td>Nazwa szkoły i telefon kontaktowy</td>
                    <td>uwagi</td>
                   

                    </thead>
                    <tbody>
    <?php while ($row = mysql_fetch_assoc($stan)) { ?>
                            <tr>
                                <td><?= $row['imie_pracownika'] . ' ' . $row['nazwisko_pracownika'] ?></td>
                                <td><?= $row['data'].' '.$row['godzina'];?></td>
                                
                                <td><?= $row['marka'] . ' ' . $row['model'] ?></td>
                                <td><?= $row['opis'] ?></td>
                                
                            </tr>
    <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="footer">
        <p>&copy; Created by Krystian Matusz 2020</p>
      </div>
            </div>
        </body>
    </html>
<?php } else { ?> <h2 style="color:#F00">Nie masz uprawnień do przegladania tej strony !!!</h2> <?php } ?>