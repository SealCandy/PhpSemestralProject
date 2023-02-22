<html>
<head>
<title>Login</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="screen" href="./css/bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" media="screen" href="./css/style.css" />
</head>
<body>

<div class="container text-center">
<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/SemProjekt/init.php');
require_once($_SERVER['DOCUMENT_ROOT'].Paths::FACADES_LOCATION.'FormValidator.php');
require_once($_SERVER['DOCUMENT_ROOT'].Paths::DATABASE_LOCATION);
require_once($_SERVER['DOCUMENT_ROOT'].Paths::MODELS_LOCATION.'Teachers.php');
require_once($_SERVER['DOCUMENT_ROOT'].Paths::MODELS_LOCATION.'Students.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    [$errors, $input] = validate_form();
    if ($errors) {
        show_form($errors);
    } else {
        process_form();
    }
} else {
    show_form();
}

function show_form($errors = array()) {
    // No defaults of our own, so nothing to pass to the
    // FormHelper constructor
    $form = new FormValidator();
    // Build up the error HTML to use later
    if ($errors) {
        $errorHtml = '<ul><li>';
            $errorHtml .= implode('</li><li>',$errors);
            $errorHtml .= '</li></ul>';
    } else {
        $errorHtml = '';
    }

    print <<<_FORM_
    <form method="POST" action="{$form->encode($_SERVER['PHP_SELF'])}">
        $errorHtml
        Username: {$form->input('text', ['name' => 'username'])} <br/>
        Password: {$form->input('password', ['name' => 'password'])} <br/>
        Are you a teacher: {$form->input('checkbox', ['name' => 'role'])} <br/>
        {$form->input('submit', ['value' => 'Log In'])}
    </form>
    _FORM_;
}
function validate_form() {
    $input = array();
    $errors = array();
    
    $database = new Database();
    $database->connect();
    if($_POST['role'] != null && $_POST['role'] === 'on'){
        $selectedUser = $database->selectRow('SELECT * FROM pedagogove WHERE kod_pedagoga = "'.$_POST['username'].'" LIMIT 1');
    }else{
        $selectedUser = $database->selectRow('SELECT * FROM studenti WHERE kod_studenta = "'.$_POST['username'].'" LIMIT 1');
    }
    
    // Make sure username is valid
    if (!in_array($_POST['username'], $selectedUser)) {
        $errors[ ] = 'Nebylo nalezeno uživatelské jméno.';
    }
    else {
        // See if password is correct
        $userPassword = $selectedUser['heslo'];
        $submittedPassword = $_POST['password'];
        if (strcmp($userPassword, $submittedPassword) !== 0) {
            $errors[ ] = 'Prosím zadejte validní jméno nebo heslo.';
        } elseif($_POST['role'] != null && $_POST['role'] = 'on'){
            $_SESSION['role'] = 'teacher';
        } else {
            $_SESSION['role'] = 'student';
        }
    }
    return array($errors, $input);

}
function process_form() {
    $redirectUrl = Paths::VIEWS_PUBLIC_LOCATION."/index.php";
    // Add the username to the session
    $database = new Database();
    $database->connect();
    if($_POST['role'] != null && $_POST['role'] === 'on'){
        $selectedUser = $database->selectRow('SELECT * FROM pedagogove WHERE kod_pedagoga = "'.$_POST['username'].'" LIMIT 1');
        $teacher = new Teachers(
            $selectedUser['kod_pedagoga'],
            $selectedUser['jmeno'],
            $selectedUser['prijmeni'],
            $selectedUser['tituly_pred_jmenem'],
            $selectedUser['tituly_za_jmenem'],
        );
        $_SESSION['user'] = serialize($teacher);
    }else{
        $selectedUser = $database->selectRow('SELECT * FROM studenti WHERE kod_studenta = "'.$_POST['username'].'" LIMIT 1');
        $student = new Students(
            $selectedUser['kod_studenta'],
            $selectedUser['jmeno'],
            $selectedUser['prijmeni'],
        );
        $_SESSION['user'] = serialize($student);
    }
    print '<p><a href="'.$redirectUrl.'">Klikněte pro přesměrováni</a> na hlavní stranu.</p>';
    sleep(3);
    header("LOCATION: ".$redirectUrl);
}
?>
</div>
</body>
</html>