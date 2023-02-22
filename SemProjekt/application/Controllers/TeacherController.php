<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/SemProjekt/init.php');
require_once($_SERVER['DOCUMENT_ROOT'].Paths::DATABASE_LOCATION);
require_once($_SERVER['DOCUMENT_ROOT'].Paths::MODELS_LOCATION.'Teachers.php');
require_once($_SERVER['DOCUMENT_ROOT'].Paths::MODELS_LOCATION.'Terms.php');
class TeacherController {

    public static function getRooms(){
        $database = new Database();
        $database->connect();
        $sqlStatement = 'SELECT * FROM mistnosti';
        $rooms = $database->selectData($sqlStatement);
        return $rooms;
    }
    public static function getSubjects(){
        $database = new Database();
        $database->connect();
        $user = unserialize($_SESSION['user']);
        $sqlStatement = 'SELECT predmety.* FROM pedagogove_predmety JOIN predmety on 
        pedagogove_predmety.zkratka_predmetu = predmety.zkratka_predmetu JOIN pedagogove 
        on pedagogove_predmety.kod_pedagoga = pedagogove.kod_pedagoga 
        WHERE pedagogove.kod_pedagoga = "'.$user->getId().'";';
        $teacherSubjects = $database->selectData($sqlStatement);
        return $teacherSubjects;
    }

    public static function getTerms(){
        $database = new Database();
        $database->connect();
        $user = unserialize($_SESSION['user']);
        $sqlStatement ='SELECT * FROM vypsane_terminy WHERE kod_pedagoga = "'.$user->getId().'"';
        $teacherTerms = $database->selectData($sqlStatement);
        return $teacherTerms;
    }
    public static function getTerm($termId){
        $database = new Database();
        $database->connect();
        $user = unserialize($_SESSION['user']);
        $sqlStatement ='SELECT * FROM vypsane_terminy WHERE id_terminu = "'.$termId.'" AND kod_pedagoga = "'.$user->getId().'"';
        $term = $database->selectRow($sqlStatement);
        return $term;
    }
    public static function createTerm($term){
        $database = new Database();
        $database->connect();
        $user = unserialize($_SESSION['user']);
        $sqlStatement = 'INSERT INTO vypsane_terminy 
        (id_terminu, zkratka_mistnosti, kod_pedagoga, zkratka_predmetu, datum_cas, max_pocet_prihlasenych, poznamka) 
        VALUES (NULL, "'.$term->getRoomId().'", "'.$user->getId().'", "'.$term->getClassId().'", 
        "'.$term->getDate().'", "'.$term->getMaximumCapacity().'", "'.$term->getNote().'")';
        $database->execute($sqlStatement);
    }

    public static function updateTerm($term){
        $database = new Database();
        $database->connect();
        $sqlStatement = 'UPDATE vypsane_terminy SET 
        zkratka_mistnosti = "'.$term->getRoomId().'", 
        zkratka_predmetu = "'.$term->getClassId().'", 
        datum_cas = "'.$term->getDate().'", 
        max_pocet_prihlasenych = "'.$term->getMaximumCapacity().'", 
        poznamka = "'.$term->getNote().'" 
        WHERE vypsane_terminy.id_terminu = "'.$term->getId().'"';
        $database->execute($sqlStatement);
    }

    public static function deleteTerm($termId){
        $database = new Database();
        $database->connect();
        $sqlStatement = 'DELETE FROM vypsane_terminy WHERE id_terminu = "'.$termId.'"';
        $database->execute($sqlStatement);
    }
}