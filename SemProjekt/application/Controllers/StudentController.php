<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/SemProjekt/init.php');
require_once($_SERVER['DOCUMENT_ROOT'].Paths::DATABASE_LOCATION);
require_once($_SERVER['DOCUMENT_ROOT'].Paths::MODELS_LOCATION.'Students.php');
class StudentController {

    public static function getSubjects(){
        $database = new Database();
        $database->connect();
        $user = unserialize($_SESSION['user']);
        $sqlStatement = 'SELECT predmety.* FROM studenti_predmety JOIN predmety on 
        studenti_predmety.zkratka_predmetu = predmety.zkratka_predmetu JOIN studenti 
        on studenti_predmety.kod_studenta = studenti.kod_studenta 
        WHERE studenti.kod_studenta = "'.$user->getId().'"';
        $studentSubjects = $database->selectData($sqlStatement);
        return $studentSubjects;
    }

    public static function getUnsignedTerms(){
        $database = new Database();
        $database->connect();
        $user = unserialize($_SESSION['user']);
        $sqlStatement = 'SELECT vypsane_terminy.* FROM studenti_predmety JOIN predmety on 
        studenti_predmety.zkratka_predmetu = predmety.zkratka_predmetu JOIN studenti 
        on studenti_predmety.kod_studenta = studenti.kod_studenta 
        JOIN vypsane_terminy on vypsane_terminy.zkratka_predmetu = studenti_predmety.zkratka_predmetu 
        WHERE studenti.kod_studenta = "'.$user->getId().'" AND 
        Not EXISTS (SELECT * FROM zapsane_terminy WHERE id_terminu = vypsane_terminy.id_terminu 
        AND zapsane_terminy.kod_studenta = "'.$user->getId().'")';
        $allAvailableTerms = $database->selectData($sqlStatement);
        return $allAvailableTerms;
    }
    public static function getSignedTerms(){
        $database = new Database();
        $database->connect();
        $user = unserialize($_SESSION['user']);
        $sqlStatement = 'SELECT vypsane_terminy.* FROM zapsane_terminy 
        JOIN vypsane_terminy on vypsane_terminy.id_terminu = zapsane_terminy.id_terminu 
        WHERE zapsane_terminy.kod_studenta = "'.$user->getId().'"';
        $allAvailableTerms = $database->selectData($sqlStatement);
        return $allAvailableTerms;
    }

    public static function signUpForTerm($termId){
        $database = new Database();
        $database->connect();
        $user = unserialize($_SESSION['user']);
        $sqlStatement = 'INSERT into zapsane_terminy (id_terminu, kod_studenta, id_vysledku) VALUES ("'.$termId.'","'.$user->getId().'", NULL)';
        echo $sqlStatement;
        $database->execute($sqlStatement);
    }

    public static function signOffForTerm($termId){
        $database = new Database();
        $database->connect();
        $user = unserialize($_SESSION['user']);
        $sqlStatement = 'DELETE FROM zapsane_terminy WHERE kod_studenta = "'.$user->getId().'" AND id_terminu = "'.$termId.'"';
        $database->execute($sqlStatement);
    }

    public static function getStudentTermCount($termId){
        $database = new Database();
        $database->connect();
        $sqlStatement = 'SELECT COUNT(*) as counter FROM zapsane_terminy WHERE id_terminu = "'.$termId.'"';
        $count = $database->selectRow($sqlStatement);
        return $count;
    }
}