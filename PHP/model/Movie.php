<?php
/**
 * Created by PhpStorm.
 * User: usuario
 * Date: 18/07/2019
 * Time: 13:39
 */

class Movie{

    private $conexion;

    private $id;
    private $title;
    private $releaseYear;

    /**
     * Movie constructor.
     * @param $conexion
     */
    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function add(){
        $insert=$this->conexion->prepare("INSERT INTO movies (TITLE, RELEASE_YEAR) VALUES (:title, :releaseYear)");
        try{
            $insert->execute(array(
                "title"=>$this->title,
                "releaseYear"=>$this->releaseYear
            ));
        }catch (PDOException $e){
            echo $e->getMessage();
            $this->conexion=null;

            return false;
        }
        $this->conexion=null;
        return true;
    }

    public function remove(){
        $delete=$this->conexion->prepare("DELETE FROM movies WHERE TITLE=?");
        try{
            $delete->execute([$this->title]);
        }catch (PDOException $e){

            echo $e->getMessage();

            $this->conexion=null;
            return 0;
        }
        $this->conexion=null;

        return $delete->rowCount();
    }

    public function findByTitle(){

        $select=$this->conexion->prepare("SELECT * FROM movies WHERE TITLE=?");
        $select->execute([$this->title]);

        $result=$select->fetch();

        return $result;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getReleaseYear()
    {
        return $this->releaseYear;
    }

    /**
     * @param mixed $releaseYear
     */
    public function setReleaseYear($releaseYear): void
    {
        $this->releaseYear = $releaseYear;
    }



}