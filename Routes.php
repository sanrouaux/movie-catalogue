<?php

    use resources\Route;
    use Controllers\WelcomeController;
    use Controllers\CatalogController;
    use Controllers\LoginController;
    use Controllers\DeleteFilmController;
    use Controllers\RetrieveFilmController;
    use Controllers\AddFilmController;
    use Controllers\EditFilmController;
    use Controllers\SigninController;
    use Controllers\RecommendFilmController;

    
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