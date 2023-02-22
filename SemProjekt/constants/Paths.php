<?php
class Paths {
    const PROJECT_LOCATION = '/SemProjekt';
    const PROJECT_VERSION = '/application';
    const CONTROLLERS_LOCATION = Paths::PROJECT_LOCATION.Paths::PROJECT_VERSION.'/Controllers/';
    const FACADES_LOCATION = Paths::PROJECT_LOCATION.Paths::PROJECT_VERSION.'/Models/Facades/';
    const VIEWS_PUBLIC_LOCATION = Paths::PROJECT_LOCATION.Paths::PROJECT_VERSION.'/Views/';
    const VIEWS_FORMS_LOCATION = Paths::VIEWS_PUBLIC_LOCATION.'/Forms/';
    const DATABASE_LOCATION = Paths::PROJECT_LOCATION.Paths::PROJECT_VERSION.'/Config/Database.php';
    const MODELS_LOCATION = Paths::PROJECT_LOCATION.Paths::PROJECT_VERSION.'/Models/';

    const ENV_LOCATION = Paths::PROJECT_LOCATION.'/.env';
}