<?php

$page = 'main';
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else
if (isset($_POST['page'])) {
    $page = $_POST['page'];
}

switch ($page) {
    case 'main':
        include 'main.php';
        break;
    case 'room':
        include 'room.php';
        break;
    case 'variable':
        include 'variable.php';
        break;
    case 'choisen':
        include 'choisen.php';
        break;
}

