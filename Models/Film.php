<?php 

class Film 
{
    public $id;
    public $name;
    public $director;
    public $year;
    public $image;

    /**
     * Getters and Setters
     */
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getDirector() {
        return $this->director;
    }

    public function setDirector($director) {
        $this->director = $director;
    }

    public function getYear() {
        return $this->year;
    }

    public function setYear($year) {
        $this->year = $year;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function __construct($id, $name, $director, $year, $image) {
        $this->id = $id;
        $this->name = $name;
        $this->director = $director;
        $this->year = $year;
        $this->image = $image;
    }

}

?>