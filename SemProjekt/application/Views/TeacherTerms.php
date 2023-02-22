<html>
<head>
<title>Terms</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="screen" href="./css/bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" media="screen" href="./css/style.css" />
</head>
<body>

<div class="container text-center">
<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'].'/SemProjekt/init.php');
    require_once($_SERVER['DOCUMENT_ROOT'].Paths::MODELS_LOCATION.'Teachers.php');
    require_once($_SERVER['DOCUMENT_ROOT'].Paths::CONTROLLERS_LOCATION.'TeacherController.php');
    require_once($_SERVER['DOCUMENT_ROOT'].Paths::CONTROLLERS_LOCATION.'StudentController.php');
        $data = TeacherController::getTerms();
if($data){
?>
      <h1>Termíny</h1>
      <table class="table table-bordered">
          <tr>
              <th>Zkratka místnosti</th>
              <th>Zkratka předmětu</th>
              <th>Datum a čas</th>
              <th>max počet</th>
              <th>Poznámka</th>
              <th>Akce</th>
          </tr>    
    <?php
    foreach ($data as $row) 
    {
        $count = StudentController::getStudentTermCount($row['id_terminu']);
        echo "<tr>"."\n";
        echo "<td>".$row['zkratka_mistnosti']."</td>"."\n";
        echo "<td>".$row['zkratka_predmetu']."</td>"."\n";
        echo "<td>".$row['datum_cas']."</td>"."\n";
        echo "<td>".$count['counter']."/".$row['max_pocet_prihlasenych']."</td>"."\n";
        echo "<td>".$row['poznamka']."</td>"."\n";
        echo "
        <td>
        <div>
        <a class=\"btn btn-info\" href=\"Forms/UpdateTermForm.php?ID=".$row['id_terminu']."\">Upravit</a>
        </div>
        <div>
        <a class=\"btn btn-danger\" href=\"TeacherTerms.php?DEL=".$row['id_terminu']."\">Odebrat</a>
        </div>
        </td>"."\n";
        echo "</tr>"."\n";
    }   
}
    if(isset($_GET['DEL'])){
        TeacherController::deleteTerm($_GET['DEL']);
        $redirectUrl = Paths::PROJECT_LOCATION.Paths::PROJECT_VERSION."/Views/TeacherTerms.php";
        unset($_GET['DEL']);
        header("LOCATION: ".$redirectUrl);
    }
    ?>
    </table>
    <div class=" text-center">
        <?php echo "<a class=\"btn btn-success\" href=\"Forms/CreateTermForm.php\">Vytvořit termín</a>" ?>
        <?php echo'<a class="btn btn-primary" href="index.php">Zpět</a>'?>
    </div>
</div>
</body>
</html>