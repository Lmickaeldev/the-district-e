<?php

namespace App\Models;

use App\Core\Db;

class Model extends Db
{
    //table de la base de données
    protected $table;

    // intance de Db
    private $db;
    //
    //function pour les 3 plats les plus vendu=populaire
        public function most_pop_plat(){     
            $query = $this->requete('SELECT COUNT(*) AS nbr_vente, plats.libelle, plats.image, plats.id, plats.prix 
            FROM commandes JOIN plats ON plats.id = commandes.id 
            JOIN livraison ON commandes.id = livraison.id 
            WHERE commandes.etat = "1" AND LOWER(plats.active) = "1" 
            GROUP BY plats.libelle, plats.image, plats.id, plats.prix 
            ORDER BY nbr_vente DESC LIMIT 3; ');
        return $query->fetchAll();
        }

    //function ppour afficher les comande en fonction de leur etat,le nom du client trié par ordre decroisant
        public function comd()
        {
            $query = $this->requete('    SELECT commandes.id, plats.libelle AS nom_plat, categories.libelle AS categorie, commandes.quantite, commandes.total, commandes.date_commande, livraison.nom AS etat, utilisateurs.username AS nom_client FROM commandes JOIN plats ON commandes.id_plat = plats.id JOIN categories ON plats.id_categorie = categories.id JOIN livraison ON commandes.etat = livraison.id JOIN utilisateurs ON commandes.id_client = utilisateurs.id ORDER BY `commandes`.`date_commande` DESC;
            ');
        return $query->fetchAll();
        }

    //SELECT commandes.id, plats.libelle AS nom_plat, categories.libelle AS categorie, commandes.quantite, commandes.total, commandes.date_commande, livraison.nom AS etat, utilisateurs.username AS nom_client FROM commandes JOIN plats ON commandes.id_plat = plats.id JOIN categories ON plats.id_categorie = categories.id JOIN livraison ON commandes.etat = livraison.id JOIN utilisateurs ON commandes.id_client = utilisateurs.id ORDER BY `commandes`.`date_commande` DESC;


    //le read du CRUD
    //on recupere les données
    public function findAll()
    {
        $query = $this->requete('SELECT * FROM ' . $this->table);
        return $query->fetchAll();
    }
    


    //afficher tout les données de la table
    public function findBy(array $criteres)
    {
        $champs =[];
        $valeurs = [];

        //on boucle pour eclater le tableau
        foreach($criteres as $champ=> $valeur){
            //select * from categorie Where active =?   
            //bindValue(1 , valeur)

            $champs[] = "$champ = ? ";
            $valeurs[] = $valeur;
        }
        //on transforme le tableau champ en une chaine de caracteres 
        $liste_champs = implode(' AND ', $champs);

        //on peut execute la requete

        return $this->requete('SELECT * FROM ' .$this->table.' WHERE '. $liste_champs,$valeurs)->fetchAll();
    }
    //affiché un id
    public function find(int $id)
    {
        return $this->requete("SELECT * FROM  {$this->table} WHERE id = $id")->fetch();
    }
    //le  create du CRUD
    public function create(model $model)
    {   
        
            $champs =[];
            $inter =[];
            $valeurs = [];

        //on boucle pour eclater le tableau
        foreach($model as $champ=> $valeur){
            if($valeur != null && $champ != 'db' && $champ != 'table'){
            //INSERT INTO categorie (libelle,image,active) VALUES (? , ? , ? )      
            $champs[] = $champ;
            $inter[] = "?";
            $valeurs[] = $valeur;
            }
        }
        //on transforme le tableau champ en une chaine de caracteres 
        $liste_champs = implode(', ', $champs);
        $liste_inter = implode(', ', $inter);

        //on peut execute la requete

        return $this->requete('INSERT INTO ' .$this->table.' ('. $liste_champs.')VALUES('.$liste_inter.')', $valeurs);
        
    }
    //update du CRUD
    public function update(int $id,model $model)
    {   
        
            $champs =[];
            $valeurs = [];

        //on boucle pour eclater le tableau
        foreach($model as $champ=> $valeur){
            if($valeur !== null && $champ != 'db' && $champ != 'table'){
            //UPDATE categorie SET libelle = ? ,image = ? ,active= ? ) WHERE id= ?      
            $champs[] = "$champ = ?" ;
            $valeurs[] = $valeur;
            }
        }
        $valeurs[] =$id;
        //on transforme le tableau champ en une chaine de caracteres 
        $liste_champs = implode(', ', $champs);

        //on peut execute la requete

        return $this->requete('UPDATE ' .$this->table.' SET '. $liste_champs.' WHERE id= ?', $valeurs);
        
    }
    //le delete du CRUD
    public function delete(int $id)
    {
        return $this->requete("DELETE FROM {$this->table} WHERE id = ? ", [$id]);
    }

    public function requete(string $sql, array $attributs = null)
    {
        // on recupere l'instance de Db
        $this->db = Db::getInstance();

        // on verfie si on a des attributs
        if ($attributs !== null){
            //requete préparé
            $query = $this->db->prepare($sql);
            $query->execute($attributs);
            return $query;
        }else{
            //requete simple
            return $this->db->query($sql);
        }
    }

    // methode d'hydratation CREATE
    public function hydrate(array $donnees){
        foreach($donnees as $key => $value){
            //on recupere le nom du setter corespondant a la clef (key)
            //libelle -> setlibelle
            $setter ='set'.ucfirst($key);
        //on verifie si le setter existe
        if (method_exists($this, $setter)) {
            //on appel le setter
            $this->$setter($value);
        }    
        }
        return $this;
    }


    public function user_co($email){
        // on recupere l'instance de Db
        $this->db = Db::getInstance();
        $query = $this->db->prepare('SELECT * FROM utilisateurs WHERE mail=?;');
        $query->execute(array($email));
        $tab = $query->fetch();
        $query->closeCursor();
        return $tab;
      }
    
     
    
    
}


?>