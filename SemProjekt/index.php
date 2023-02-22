<html>
<head><title>Semestral Project</title></head>
<body>
<b>
    <?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/SemProjekt/init.php');

    session_start();
    if (array_key_exists('user', $_SESSION)) {
        print '<form action="'.Paths::VIEWS_PUBLIC_LOCATION.'logout.php">
                <input type="submit" value="Odhlásit" />
                </form>';
    } else {
        print
            '<form action="'.Paths::VIEWS_PUBLIC_LOCATION.'login.php">
                <input type="submit" value="Login" />
            </form>';
    }
    ?>
    <h1><?php print "Log in pro uživatele"; ?></h1>
</b>
</body>
</html>