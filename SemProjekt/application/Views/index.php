<html>
<head>
<title>Index</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="screen" href="./css/bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" media="screen" href="./css/style.css" />
</head>
<body>

<div class="container text-center">
    <?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/SemProjekt/init.php');
    require_once($_SERVER['DOCUMENT_ROOT'].Paths::MODELS_LOCATION.'Teachers.php');
    require_once($_SERVER['DOCUMENT_ROOT'].Paths::MODELS_LOCATION.'Students.php');
    session_start();
    if (array_key_exists('user', $_SESSION)) {
        $user = unserialize($_SESSION['user']);
        print 'Welcome: '.$user->getName();
        print '<form action="'.Paths::VIEWS_PUBLIC_LOCATION.'logout.php">
                <input type="submit" value="Odhlásit" />
                </form>';
                if($_SESSION['role'] == 'student'){
                   echo '<h1><a href="'.Paths::VIEWS_PUBLIC_LOCATION.'subjects.php">Předměty<a></h1>';
                   echo '<h1><a href="'.Paths::VIEWS_PUBLIC_LOCATION.'StudentTerms.php">Termíny<a></h1>';
                }else{
                    echo '<h1><a href="'.Paths::VIEWS_PUBLIC_LOCATION.'subjects.php">Předměty<a></h1>';
                    echo '<h1><a href="'.Paths::VIEWS_PUBLIC_LOCATION.'TeacherTerms.php">Termíny<a></h1>';
                }
                
    } else {
        print
            '<form action="'.Paths::VIEWS_PUBLIC_LOCATION.'login.php">
                <input type="submit" value="Login" />
            </form>';
    }
    ?>
</div>
</body>
</html>