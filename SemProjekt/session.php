<?php

session_start();

$_SESSION['login2'] = 'logged';
$getAction = '';
if(isset($_GET['action'])) $getAction = $_GET['action'];

if ($getAction == 'login') {
    $_SESSION['login'] = 'logged'; 
} elseif ($getAction == 'logout') {
    unset($_SESSION['login']);
}

if (isset($_SESSION['login']) && $_SESSION['login'] == 'logged') {
    echo "Uživatel je přihlášen<br>";
    echo '<a href="./session.php?action=logout">odhlásit</a>';
} else {
    echo "Uživatel je odhlášen<br>";
    echo '<a href="./session.php?action=login">přihlásit</a>';
}

echo $_SESSION['login2']."<br>";

echo session_cache_expire();

?>