<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        <link rel="shortcut icon" type="image/png" href="./images/favicon.ico" />
        <title>Home</title>        

        <link rel="stylesheet" type="text/css" href="./Views/css/catalog.css" />
        <script type="text/javascript" src="Views/js/catalog.js"></script>

        <script src="https://kit.fontawesome.com/a64037f8e7.js" crossorigin="anonymous"></script>
    </head>
    <body>

        <div class="header">
            <table class="header table" >
                <tr>
                    <td>
                        <i class="fas fa-user"></i>
                        <p id="username"></p>
                    <td>
                </tr>
                <tr>
                    <td>
                        <a class="logout">Salir</a>
                    <td>
                </tr>
            </table>
        </div>
        
        <h1 class="catalog-title">Catálogo de películas</h1>

        <button id="add-film-button" class="admin-only add-film">Agregar una película</button>
        <button id="recommend-film-button" class="user-only recommend-film">Quiero que me recomienden una peli</button>
        
        <table class="catalog">
            <tr>
                <td class="thead">Nombre</td>
                <td class="thead">Director</td>
                <td class="thead">Año</td>
                <td class="thead">Póster</td>
                <td class="thead admin-only">Acciones</td>
            </tr>
            <?php foreach($data as $film) :?>
                <tr>
                    <td><?php echo $film->getName() ?></td>
                    <td><?php echo $film->getDirector() ?></td>
                    <td><?php echo $film->getYear() ?></td>
                    <td><img src="./images/posters/<?php echo $film->getImage() ?>" /></td>
                    <td class="admin-only"><button class="edit-button edit-button-<?php echo $film->getId() ?>">Editar</button><button class="delete-button delete-button-<?php echo $film->getId() ?>">Eliminar</button></td>
                </tr>
            <?php endforeach ?>                        
        </table>

        <!--Ventana modal Agregar Película-->
        <div id="addFilmModal" class="modalContainer">
            <div class="modal-content">
                <span class="close">×</span>
                <h2 id="modal-title">Agregar Película</h2>
                <div class="name-input">
                    <input class="input add-input-name" type="text" placeholder="Nombre" />
                    <p class="add-validation-name" hidden>* Campo requerido</p>
                </div>
                <div class="director-input">
                    <input class="input add-input-director" type="text" placeholder="Director" />
                    <p class="add-validation-director" hidden>* Campo requerido</p>
                </div>
                <div class="year-input">
                    <input class="input add-input-year" type="text" placeholder="Año de estreno" />
                    <p class="add-validation-year" hidden>* Introduzca un año válido</p>
                </div>
                Póster:
                <br>
                <img id="add-poster-preview" src="./images/empty-image.png">
                <br>
                <div class="photo-input">
                    <input class="input add-input-poster" type="file"/>
                    <p class="add-validation-photo" hidden>* Campo requerido</p>
                </div>
                <button class="accept-add-film-button">Agregar</button>
            </div>
	    </div>

        <!--Ventana Modal Editar Película-->
        <div id="editFilmModal" class="modalContainer">
            <div class="modal-content">
                <span class="close">×</span>
                <h2 id="modal-title">Editar Película</h2>
                <div class="edit-name">
                    <input class="edit-input-name" type="text" placeholder="Nombre" />
                    <p class="edit-validation-name" hidden>* Campo requerido</p>
                </div>
                <div class="edit-director">
                    <input class="edit-input-director" type="text" placeholder="Director" />
                    <p class="edit-validation-director" hidden>* Campo requerido</p>
                </div>
                <div class="edit-year">
                    <input class="edit-input-year" type="text" placeholder="Año de estreno" />
                    <p class="edit-validation-year" hidden>* Introduzca un año válido</p>
                </div>
                Póster:
                <br>
                <img id="edit-poster-preview" src=""/>
                <div class="edit-poster">
                    <input class="edit-input-poster" type="file"/>
                </div>
                <button class="accept-edit-film-button">Aceptar</button>
            </div>
	    </div>      

    </body>
</html>



