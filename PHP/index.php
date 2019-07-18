<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$request = explode('/', $_SERVER['REQUEST_URI']);
array_shift($request);

if(isset($request[1]) && ($request[0] == "addmovie" && isset($request[2]) || $request[0] == 'removemovie')){

    require_once "model/Movie.php";
    require_once "core/Conectar.php";
    $conectar = new Conectar();
    $conexion = $conectar->conexion();

    $movie = new Movie($conexion);

    if($request[0] == "addmovie"){
        if(strlen($request[1])>100)
            die(json_encode(array("error" => "The title parameter has to be 100 character max")));
        $movie->setTitle($request[1]);

        if(!empty($movie->findByTitle())){

            die(json_encode(array("error" => "The movie already exists")));
        }else{
            if(strlen($request[2])!=4)
                die(json_encode(array("error" => "The year has to be a 4 digit number")));
            $movie->setReleaseYear($request[2]);

            if($movie->add()){
                die(json_encode(array("message" => "The movie has been added")));
            }else{
                die(json_encode(array("error" => "An error with the database has occurred")));
            }
        }

    }else{

        $movie->setTitle($request[1]);
        if($movie->remove()==0){
            die( json_encode(array("error" => "There is no movie with that title")));
        }else{
            die(json_encode(array("message" => "The movie has been deleted")));
        }

    }
}else{
    die(json_encode(array("message" => "Try with /addmovie/{title}/{year} or /removemovie/{title}")));

}

