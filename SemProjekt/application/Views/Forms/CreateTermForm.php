<?php
session_start();
error_reporting(E_ALL);
require_once($_SERVER['DOCUMENT_ROOT'].'/SemProjekt/init.php');
require_once($_SERVER['DOCUMENT_ROOT'].Paths::MODELS_LOCATION.'Terms.php');
require_once($_SERVER['DOCUMENT_ROOT'].Paths::CONTROLLERS_LOCATION.'TeacherController.php');

$rooms = TeacherController::getRooms();
$subjects = TeacherController::getSubjects(); 
echo '<form method="POST" action="CreateTermForm.php">';
echo 'Místnost:';
echo '<select name="room">';
foreach($rooms as $row){
echo '<option value="'.$row['zkratka_mistnosti'].'">'.$row['zkratka_mistnosti'].'</option>';
}
echo '</select>';
echo '<br/>';
echo 'Předměty:';
echo '<select name="class">';
foreach($subjects as $row){
echo '<option value="'.$row['zkratka_predmetu'].'">'.$row['zkratka_predmetu'].'</option>';
}
echo '</select>';
echo '<br/>';
echo 'Datum:';
echo '<input type="datetime-local" min="'.date('Y-m-d').' 00:00:00" name="date">';
echo '<br/>';
echo 'Maximální počet studentů:';
echo '<input type="number" name="max" min="1">';
echo '<br/>';
echo 'Note:';
echo '
<textarea rows="4" cols="50" name="note">
</textarea>      
';
echo '<br/>';
echo '<input type="submit" name="CREATE" value="Přidat">';
echo '</form>';

if(isset($_POST['CREATE'])){
    $date = date('y-m-d H:i:s',strtotime($_POST['date']));
    echo $date;
    $term = new Terms(
        $_POST['room'],
        $_POST['class'],
        $date,
        $_POST['max'],
        $_POST['note'],
        $_POST['room'],
    );
    TeacherController::createTerm($term);
    $redirectUrl = Paths::PROJECT_LOCATION.Paths::PROJECT_VERSION."/Views/TeacherTerms.php";
    unset($_GET['CREATE']);
    header("LOCATION: ".$redirectUrl);
}