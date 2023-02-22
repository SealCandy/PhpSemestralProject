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
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'].'/SemProjekt/init.php');
    require_once($_SERVER['DOCUMENT_ROOT'].Paths::MODELS_LOCATION.'Students.php');
    require_once($_SERVER['DOCUMENT_ROOT'].Paths::CONTROLLERS_LOCATION.'StudentController.php');
        $data = StudentController::getUnsignedTerms();
        $dataSigned = StudentController::getSignedTerms();
if($data){
?>
      <h1>Produkty</h1>
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
        if($count['counter'] >= $row['max_pocet_prihlasenych']){
            echo "
            <td>
            <a class=\"disabled btn btn-success\" href=\"StudentTerms.php?IN=".$row['id_terminu']."\">Přihlásit se</a>
            </td>"."\n";
        }else{
            echo "
            <td>
            <a class=\"btn btn-success\" href=\"StudentTerms.php?IN=".$row['id_terminu']."\">Přihlásit se</a>
            </td>"."\n";
        }
        echo "</tr>"."\n";
    }   
}
if($dataSigned){
    foreach ($dataSigned as $row) 
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
        <a class=\"btn btn-danger\" href=\"StudentTerms.php?OUT=".$row['id_terminu']."\">Odhlásit se</a>
        </td>"."\n";
        echo "</tr>"."\n";
    }
}
    if(isset($_GET['IN'])){
        StudentController::signUpForTerm($_GET['IN']);
        $redirectUrl = Paths::PROJECT_LOCATION.Paths::PROJECT_VERSION."/Views/StudentTerms.php";
        unset($_GET['IN']);
        header("LOCATION: ".$redirectUrl);
    }
    if(isset($_GET['OUT'])){
        StudentController::signOffForTerm($_GET['OUT']);
        $redirectUrl = Paths::PROJECT_LOCATION.Paths::PROJECT_VERSION."/Views/StudentTerms.php";
        unset($_GET['OUT']);
        header("LOCATION: ".$redirectUrl);
    }
    ?>
    </table>
    <?php echo'<a class="btn btn-primary" href="index.php">Zpět</a>'?>
</div>
</body>
</html>