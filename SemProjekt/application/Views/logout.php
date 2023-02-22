<html>
<head>
<title>Products</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="screen" href="./css/bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" media="screen" href="./css/style.css" />
</head>
<body>

<div class="container text-center">
<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/SemProjekt/init.php');

session_start();
$redirectUrl = Paths::PROJECT_LOCATION.Paths::PROJECT_VERSION."/Views/index.php";
unset($_SESSION['user']);
unset($_SESSION['role']);
print 'Nashledanou.';
print '<p><a href="'.$redirectUrl.'">Klikněte pro přesměrováni</a> na hlavní stranu.</p>';
sleep(3);
header("LOCATION: ".$redirectUrl);
?>
</div>
</body>
</html>