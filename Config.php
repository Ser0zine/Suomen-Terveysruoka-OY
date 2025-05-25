<?php

$Conn = new mysqli("localhost", "root", "", "suomen_terveysruoka_oy");
if ($Conn->connect_error) die("Yhteys epäonnistui: " . $Conn->connect_error);

session_start();

?>