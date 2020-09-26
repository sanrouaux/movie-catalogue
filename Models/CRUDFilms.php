<?php

require_once('./Models/Film.php');
require_once('./resources/DatabaseAccess.php');

class CRUDFilms
{

    public static function getFullCatalog() {        
        $dataAccessObject = DatabaseAccess::getDatabaseAccess();
        $query = 'SELECT * FROM catalog';
        $data = $dataAccessObject->query($query);

        $films = array();
        foreach($data as $film) {
            array_push($films, new Film($film['id'], $film['film_name'], $film['film_director'], $film['year_of_release'], $film['image']));
        }
        return $films;
    }


    public static function getFilmById($id) {     
        $dataAccessObject = DatabaseAccess::getDatabaseAccess();
        $query = 'SELECT * FROM catalog WHERE id = ' . $id;
        $data = $dataAccessObject->query($query);
        if($data) {
            $film = new Film($data[0]['id'], $data[0]['film_name'], $data[0]['film_director'], $data[0]['year_of_release'], $data[0]['image']);
            $response = $film;
        }
        else {
            $response = false;
        }        
        return $response;
    }


    public static function addFilm($name, $director, $year, $poster, $photoExtension) {  

        $photoName = date('U') . "." . $photoExtension;
        $result = move_uploaded_file($poster, "./images/posters/" . $photoName);

        if($result) {
            $dataAccessObject = DatabaseAccess::getDatabaseAccess();
            $query = 'INSERT INTO catalog (film_name, film_director, year_of_release, image) VALUES ("' . $name . '", "' . $director . '", "' . $year . '", "' . $photoName . '")';
            $response = $dataAccessObject->query($query);
        }
        else {
            $response = false;
        }
        return $response;
    }


    public static function deleteFilmById($id) {   
        $dataAccessObject = DatabaseAccess::getDatabaseAccess();         
        $query = 'DELETE FROM catalog WHERE id = ' . $id;
        $response = $dataAccessObject->query($query);
        return $response;
    }

    
    public static function updateFilm($id, $name, $director, $year, $imageTempLocation = null, $imageExtension = null) {  

        $dataAccessObject = DatabaseAccess::getDatabaseAccess();

        if($imageTempLocation != null) {
            $photoName = date('U') . "." . $imageExtension;
            $query = 'UPDATE catalog SET film_name = "' . $name . '", film_director = "' . $director . '", year_of_release = "' . $year . '", image = "' . $photoName . '" WHERE id = ' . $id;
            $result = move_uploaded_file($imageTempLocation, "./images/posters/" . $photoName);
            if($result) {
                $response = $dataAccessObject->query($query);
            }
            else {
                $response = false;
            }
        }
        else {
            $query = 'UPDATE catalog SET film_name = "' . $name . '", film_director = "' . $director . '", year_of_release = "' . $year . '" WHERE id = ' . $id;
            $response = $dataAccessObject->query($query);
        }        
        
        return $response;
    }
}

?>