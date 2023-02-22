<?php
session_start();
error_reporting(E_ALL);
require_once($_SERVER['DOCUMENT_ROOT'].'/SemProjekt/init.php');
require_once($_SERVER['DOCUMENT_ROOT'].Paths::MODELS_LOCATION.'Terms.php');
require_once($_SERVER['DOCUMENT_ROOT'].Paths::CONTROLLERS_LOCATION.'TeacherController.php');

if(isset($_POST['Update'])){
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
    $term->setId((int)$_POST['ID']);
    TeacherController::updateTerm($term);
    $redirectUrl = Paths::PROJECT_LOCATION.Paths::PROJECT_VERSION."/Views/TeacherTerms.php";
    unset($_POST['Update']);
    header("LOCATION: ".$redirectUrl);
}

$rooms = TeacherController::getRooms();
$subjects = TeacherController::getSubjects(); 
$prevTerm = TeacherController::getTerm($_GET['ID']);

echo '<form method="POST" action="UpdateTermForm.php">';
echo 'Místnost:';
echo '<select name="room">';
foreach($rooms as $row){
    if($row['zkratka_mistnosti'] == $prevTerm['zkratka_mistnosti']){
        echo '<option selected value="'.$row['zkratka_mistnosti'].'">'.$row['zkratka_mistnosti'].'</option>';
    }else{
        echo '<option value="'.$row['zkratka_mistnosti'].'">'.$row['zkratka_mistnosti'].'</option>';
    }
}
echo '</select>';
echo '<br/>';
echo 'Předměty:';
echo '<select name="class">';
foreach($subjects as $row){
    if($row['zkratka_predmetu'] == $prevTerm['zkratka_predmetu']){
        echo '<option selected value="'.$row['zkratka_predmetu'].'">'.$row['zkratka_predmetu'].'</option>';
    }else{
        echo '<option value="'.$row['zkratka_predmetu'].'">'.$row['zkratka_predmetu'].'</option>';
    }
}
echo '</select>';
echo '<br/>';
echo 'Datum:';
echo '<input type="datetime-local" value="'.$prevTerm['datum_cas'].'" min="'.date('y-m-d H:i:s').'" name="date">';
echo '<br/>';
echo 'Maximální počet studentů:';
echo '<input value="'.$prevTerm['max_pocet_prihlasenych'].'" type="number" name="max" min="1">';
echo '<br/>';
echo 'Note:';
echo '
<textarea rows="4" cols="50" name="note">
'.$prevTerm['poznamka'].'
</textarea>      
';
echo '<br/>';
echo '<input hidden name="ID" value="'.$_GET['ID'].'">';
echo '<input type="submit" name="Update" value="Uložit">';
echo '</form>';