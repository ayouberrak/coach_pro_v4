<?php

namespace App\Models;

class Sport{
    private ?int $idSport;
    private string $type;
    private string $description;

    public function __construct(?int $idSport = null , string $type , string $description){
        $this->idSport = $idSport;
        $this->type = $type;
        $this->description = $description;
    }

    public function getIdSport(){
        return $this->idSport;
    }
    public function getType(){
        return $this->type;
    }

    public function getDescription(){
        return $this->description;
    }




    
}