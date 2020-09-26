<?php

    require_once('./resources/Route.php');
    require_once('./Controllers/CatalogController.php');
    require_once('./Controllers/WelcomeController.php');
    require_once('./Controllers/LoginController.php');
    require_once('./Controllers/DeleteFilmController.php');
    require_once('./Controllers/RetrieveFilmController.php');
    require_once('./Controllers/AddFilmController.php');
    require_once('./Controllers/EditFilmController.php');
    require_once('./Controllers/SigninController.php');
    require_once('./Controllers/RecommendFilmController.php');


    Route::set('', function() {
        $controller = new WelcomeController();
        $controller->execute();
    });

    Route::set('login', function() {
        $controller = new LoginController();
        $controller->execute();
    });

    Route::set('signin', function() {
        $controller = new SigninController();
        $controller->execute();
    });

    Route::set('catalog', function() {
        $controller = new CatalogController();
        $controller->execute();
    });

    Route::set('deletefilm', function() {
        $controller = new DeleteFilmController();
        $controller->execute();
    });

    Route::set('retrievefilm', function() {
        $controller = new RetrieveFilmController();
        $controller->execute();
    });

    Route::set('addfilm', function() {
        $controller = new AddFilmController();
        $controller->execute();
    });

    Route::set('editfilm', function() {
        $controller = new EditFilmController();
        $controller->execute();
    });

    Route::set('recommendfilm', function() {
        $controller = new RecommendFilmController();
        $controller->execute();
    });

?>