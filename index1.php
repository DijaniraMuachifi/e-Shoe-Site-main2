<?php
// index.php
include 'config.php'; // This file should define an array of menu items

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch($page) {
    case 'gallery':
        include 'gallery.php';
        break;
    case 'contact':
        include 'contact.php';
        break;
    case 'messages':
        include 'messages.php';
        break;
    case 'login':
        include 'login.php';
        break;
    case 'logout':
        include 'logout.php';
        break;
    default:
        include 'home.php';
}
?>