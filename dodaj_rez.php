<?php
session_start();
if ($_SESSION['rola'] == 'klient') :
    require_once('../connect.php');
    $pracownicy = mysql_query("Select * from pracownicy") or die('Nie udalo się pobrać ');
    $klienci = mysql_query("Select id,imie,nazwisko from users where rola = 'klient'") or die('Nie udalo się pobrać klientów');
    ?>
    <!DOCTYPE HTML>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <title>WORD Przemyśl</title>
            <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/css/bootstrap.min.css" >
            <link rel="stylesheet" href="../bootstrap/DT_bootstrap.css" >
            <link href="../bootstrap/bootstrap.css" rel="stylesheet" >
            <link href="../bootstrap/justified-nav.css" rel="stylesheet" >
            
            <link rel="stylesheet" href="../css/jquery-ui-1.8.21.custom.css">
            <link rel="stylesheet" href="../css/style.css">
            <script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
            <script src="http://jquery-ui.googlecode.com/svn/trunk/ui/i18n/jquery.ui.datepicker-pl.js"></script> 
            <script src="../js/jquery.ui.core.js"></script>
            <script src="../js/jquery.ui.widget.js"></script>
            <script src="../js/datapicker.js"></script>
            <script>
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
                            
                            
                            
                            $.ajax({
                                type: "POST",
                                url: "../ajax.php",
                                data: {id_pracownika: $(this).val(), funkcja: 'rozklad_pracy'}
                            }).done(function(data) {
                                $('#rozklad_pracy').html(' ');
                                $('#rozklad_pracy').html(data);
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
                             $('#godziny').html(' ');
                            $('#godziny').append(data);
                            $('#godziny').append('<option></option>');
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
                    <li><a href='../wyloguj.php'>Wyloguj</a></li>
                </ul>
            </div>
            
            <div id="rezerwacje">
                
                <form action="dodaj.php" method="post">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="tab">
                    <input type="hidden" name="co" value="rez" />
                    <tr><td><label for="pracownik">Wybierz pojazd a pojawią się dostepne godziny</label>
                    <select id="pracownik" name="pracownik">
                        <option value="none"> </option>
                        <?php while ($row = mysql_fetch_assoc($pracownicy)) : ?>
                            <option value="<?= $row['id_pracownika'] ?>"><?= $row['imie'] . ' ' . $row['nazwisko'] ?></option>
    <?php endwhile; ?>
                    </select></td>

                    <td><label for="data">Wybierz date</label><br>
                       <input type="text" name="data" id="data" /><br>
                       <label for="data">Wybierz godzinę</label>
                        <select id="godziny" name="godziny">
                        </td>


                    

                    </tr>
                   <br>
                   <tr>
                       <td>
                                           <table id="rozklad_pracy">
                    
                </table>
                       </td>
                       <td> <label for="marka">Wpisz nazwę OSK</label><br>
                   <input type="text" name="marka" id="login" required="required"/><br></td>
                   <td><label for="model">Podaj nr. telefonu</label><br>
                       <input type="text" name="model" id="login" required="required"/><br></td>
                   </tr>
                   <tr> <td> <button class="btn btn-lg btn-success" style="width: 200px; " type="reset">Wyczyść</button></td>
                       <td><label for="opis">Uwagi:</label><br>
                 <textarea name="opis" id="opis" ></textarea></td>
                       <td><button class="btn btn-lg btn-primary btn-block" style="width: 200px;" type="submit">Zapisz</button></td>
            </tr>
                    </table>
                </form>
            </div>
            <div id="dane">

            </div
            
            <div class="footer">
        <p>&copy; Created by Krystian Matusz 2020</p>
      </div>
            
        </body>
    </html>
<?php else : ?> <h2 style="color:#F00">Nie masz uprawnień do przegladania tej strony !!!</h2> <?php endif; ?>