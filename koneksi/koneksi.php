<?php
/*
  | Source Code Aplikasi Rental Mobil PHP & MySQL
  | 
  | @package   : rentalmobil_php
  | @file	     : koneksi.php 
  | @author    : faqoy@gmail.com
  | 
  | 
  | 
  | 
 */
$user = 'php_user';
$pass = 'php_user';

$koneksi = new PDO("mysql:host=localhost;dbname=rentalmobil_php", $user, $pass);
$con = mysqli_connect("localhost", "php_user", "php_user", "rentalmobil_php");

global $url;
$url = "https://localhost/rentalmobil-php/";

$sql_web = "SELECT * FROM infoweb WHERE id = 1";
$row_web = $koneksi->prepare($sql_web);
$row_web->execute();
global $info_web;
$info_web = $row_web->fetch(PDO::FETCH_OBJ);

error_reporting(0);
