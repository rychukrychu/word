<?php
mysql_connect("localhost","root","") or die('Nie udało się polączyć z bazą');
mysql_select_db("firma") or die('Nie udało się wybrać bazy danych');
mysql_query("SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
?>