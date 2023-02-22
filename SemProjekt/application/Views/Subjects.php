<html>
<head>
<title>Subjects</title>
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
    require_once($_SERVER['DOCUMENT_ROOT'].Paths::MODELS_LOCATION.'Students.php');
    require_once($_SERVER['DOCUMENT_ROOT'].Paths::CONTROLLERS_LOCATION.'StudentController.php');
    require_once($_SERVER['DOCUMENT_ROOT'].Paths::CONTROLLERS_LOCATION.'TeacherController.php');
    if($_SESSION['role'] == 'student'){
        $data = StudentController::getSubjects();
    }
    else{
        $data = TeacherController::getSubjects();
    }
if($data){
?>
      <h1>Předměty</h1>
      <table class="table table-bordered">
          <tr>
              <th>Zkratka předmětu</th>
              <th>Název</th>
              <th>Počet kreditů</th>
              <th>Počet hodin přednášek</th>
              <th>Počet hodin cvičení</th>
              <th>Ukončení</th>
              <th>Anotace</th>
          </tr>    
    <?php
    foreach ($data as $row) 
    {
        echo "<tr>"."\n";
        echo "<td>".$row['zkratka_predmetu']."</td>"."\n";
        echo "<td>".$row['nazev']."</td>"."\n";
        echo "<td>".$row['pocet_kreditu']."</td>"."\n";
        echo "<td>".$row['pocet_hodin_prednasek']."</td>"."\n";
        echo "<td>".$row['pocet_hodin_cviceni']."</td>"."\n";
        echo "<td>".$row['ukonceni']."</td>"."\n";
        echo "<td>".$row['anotace']."</td>"."\n";
        echo "</tr>"."\n";
    }
}
    ?>
    </table>
    <?php echo'<a class="btn btn-primary" href="index.php">Zpět</a>'?>
</div>
</body>
</html>