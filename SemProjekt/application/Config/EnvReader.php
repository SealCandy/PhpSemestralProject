<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/SemProjekt/init.php');

function readEnv(){
    return parse_ini_file($_SERVER['DOCUMENT_ROOT'].Paths::ENV_LOCATION);
}