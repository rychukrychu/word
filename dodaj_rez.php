<?php
session_start();
if ($_SESSION['rola'] == 'admin') :
    require_once('../connect.php');
    $pracownicy = mysql_query("Select * from pracownicy") or die('Nie udalo się pobrać pracowników') or die('Nie udalo się pobrać pracowników');
    $klienci = mysql_query("Select id,imie,nazwisko from users where rola = 'klient'") or die('Nie udalo się pobrać klientów');
    ?>
    <!DOCTYPE HTML>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <title> WORD Przemyśl</title>
            <link rel="stylesheet" href="../css/jquery-ui-1.8.21.custom.css">
            <!--<link rel="stylesheet" href="../css/style.css"> -->
            
            <!--<script src="http://jquery-ui.googlecode.com/svn/trunk/ui/i18n/jquery.ui.datepicker-pl.js"></script> -->
            <script src="../js/jquery.ui.core.js"></script>
            <script src="../js/jquery.ui.widget.js"></script>
            <script src="../js/datapicker.js"></script>
            
                
                <script type = "text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js" ></script>
             <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js" ></script>
            <script type = "text/javascript" src = "../bootstrap/DT_bootstrap.js"  ></script>
            <script type = "text/javascript" charset = "utf-8" language = "javascript" src = "../bootstrap/jquery.dataTables.js" ></script>
 
            <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap.min.css" >
            <link rel="stylesheet" href="../bootstrap/DT_bootstrap.css" >
            <link href="../bootstrap/bootstrap.css" rel="stylesheet" >

            <link href="../bootstrap/justified-nav.css" rel="stylesheet" >


            <script type="text/javascript">
                
                
                
                
                $(function() {
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

                        console.log(dni);
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

                    }

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
                            console.log(data);
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
            </style>
        </head>
        <body>
             <div class ="masthead2">
                    <img src="images/leftbox-logo.png" class="logo">
                    <div class="if_logged"> 
                    <?php
                    if (isset($_SESSION['login'])) {
                        echo "zalogowany jako: " . $_SESSION['login'];
                        echo "<a href='wyloguj.php'> Wyloguj</a>";
                    }
                    ?>
                </div>
                    </div>
            <div class="masthead">
            <div id="navi">
                <ul class="nav nav-justified">
                    <li><a href="../index.php">Strona główna</a></li>
                    <li><a href="index.php">Rezerwacje</a></li>
                    <li><a href="pracownicy.php">Pracownicy</a></li>
                    <li><a href="klienci.php">Klienci</a></li>
                    <li><a href="dodaj_rez.php">Dodaj rezerwacje</a></li>
                </ul>
            </div>
            </div>
                      <div id="rezerwacje">
                <form action="dodaj.php" method="post">
                    <input type="hidden" name="co" value="admin_dodaj_rez" />
                   <label for="pracownik">Wybierz Klienta</label>
                    <select id="klient" name="klient">
                        <option value="none"> </option>
                        <?php while ($row1 = mysql_fetch_assoc($klienci)) : ?>
                            <option value="<?= $row1['id'] ?>"><?= $row1['imie'] . ' ' . $row1['nazwisko'] ?></option>
    <?php endwhile; ?>
                    </select>
                    
                    <label for="pracownik">Wybierz pracownika</label>
                    <select id="pracownik" name="pracownik">
                        <option value="none"> </option>
                        <?php while ($row = mysql_fetch_assoc($pracownicy)) : ?>
                            <option value="<?= $row['id_pracownika'] ?>"><?= $row['imie'] . ' ' . $row['nazwisko'] ?></option>
    <?php endwhile; ?>
                    </select>

                    <label for="data">Wybierz date</label>
                    <input type="text" name="data" id="data" /><br>


                    

                    <label for="data">Wybierz godzinę</label>
                    <select id="godziny" name="godziny">
                        
                    </select>
                   <br>

                    <input type="reset" value="Wyczyść" />
                    <input type="submit" value="zapisz" />
                </form>
            </div>
            <div id="dane">
            </div>
        </body>
    </html>
<?php else : ?> <h2 style="color:#F00">Nie masz uprawnień do przegladania tej strony !!!</h2> <?php endif; ?>