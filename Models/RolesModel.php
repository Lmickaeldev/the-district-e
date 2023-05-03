<?php
namespace App\Models;

use App\Models\Model;

class RolesModel extends Model{

    protected $id;
    protected $nom;
    protected $privilleges;

    //constructuer
    public function __construct()
    {
     $this->table='roles';   
    }

    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of privilleges
     */ 
    public function getPrivilleges()
    {
        return $this->privilleges;
    }

    /**
     * Set the value of privilleges
     *
     * @return  self
     */ 
    public function setPrivilleges($privilleges)
    {
        $this->privilleges = $privilleges;

        return $this;
    }
}


?>