<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
}

