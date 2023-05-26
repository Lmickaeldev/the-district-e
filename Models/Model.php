<?php

namespace App\Models;

use App\Core\Db;

class Model extends Db
{
    //table de la base de données
    protected $table;

    // intance de Db
    private $db;
    
    /**
     * function pour les 3 plats les plus vendu=populaire
     *
     * @return void
     */
        public function most_pop_plat(){     
            $query = $this->requete('SELECT COUNT(*) AS nbr_vente, plats.libelle, plats.image, plats.id, plats.prix 
            FROM commandes JOIN plats ON plats.id = commandes.id 
            JOIN livraison ON commandes.id = livraison.id 
            WHERE commandes.etat = "1" AND LOWER(plats.active) = "1" 
            GROUP BY plats.libelle, plats.image, plats.id, plats.prix 
            ORDER BY nbr_vente DESC LIMIT 3; ');
        return $query->fetchAll();
        }

    
    /**
     * function ppour afficher les comande en fonction de leur etat,le nom du client trié par ordre decroisant
     *
     * @return void
     */
        public function comd()
        {
            $query = $this->requete('    SELECT commandes.id, plats.libelle AS nom_plat, categories.libelle AS categorie, commandes.quantite, commandes.total, commandes.date_commande, livraison.nom AS etat, utilisateurs.username AS nom_client FROM commandes JOIN plats ON commandes.id_plat = plats.id JOIN categories ON plats.id_categorie = categories.id JOIN livraison ON commandes.etat = livraison.id JOIN utilisateurs ON commandes.id_client = utilisateurs.id ORDER BY `commandes`.`date_commande` DESC;
            ');
        return $query->fetchAll();
        }


    
    /**
     * function qui permets de recuperer les commande en fonction de l'id client
     *
     * @param integer $id
     * @return void
     */
    public function comdid(int $id)
    {
        return $this->requete("SELECT commandes.id, plats.libelle AS nom_plat, categories.libelle AS categorie, commandes.quantite, commandes.total, commandes.date_commande, livraison.nom AS etat, utilisateurs.username AS nom_client FROM commandes JOIN plats ON commandes.id_plat = plats.id JOIN categories ON plats.id_categorie = categories.id JOIN livraison ON commandes.etat = livraison.id JOIN utilisateurs ON commandes.id_client = utilisateurs.id  WHERE id_client = $id")->fetchall();
    }

    //le read du CRUD
    /**
     * functon qui permet le read des donné de la table en ALL
     *
     * @return void
     */
    public function findAll()
    {
        $query = $this->requete('SELECT * FROM ' . $this->table);
        return $query->fetchAll();
    }
    /**
     * function permetant de recuperer, d'affiché les donné de la tble ""
     *
     * @param array $criteres
     * @return void
     */
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
    /**
     * function qui permet le read en fonction d'un id
     *
     * @param integer $id
     * @return void
     */
    public function find(int $id)
    {
        return $this->requete("SELECT * FROM  {$this->table} WHERE id = $id")->fetch();
    }
    /**
     * function permetant la creation du crud
     *
     * @param model $model
     * @return void
     */
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
    /**
     * function pertant l'update
     *
     * @param integer $id
     * @param model $model
     * @return void
     */
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
    /**
     * functon permetant le delete
     *
     * @param integer $id
     * @return void
     */
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

    
    public function user_co($email){
        // on recupere l'instance de Db
        $this->db = Db::getInstance();
        $query = $this->db->prepare('SELECT * FROM utilisateurs WHERE mail=?;');
        $query->execute(array($email));
        $tab = $query->fetch();
        $query->closeCursor();
        return $tab;
      }
    /**
     * function permetant la recherche de plat
     *
     * @param [type] $search
     * @return void
     */
      function search_plat($search){
        $this->db = Db::getInstance();
        $query = $this->db->prepare('SELECT * FROM plats WHERE libelle LIKE ? AND LOWER(plats.active) = "1"');
        $query->bindValue(1, "%$search%");
        $query->execute();
        $tab = $query->fetchAll();
        $query->closeCursor();
        return $tab;
    }
    /**
     * function permetant la recherche de categorie
     *
     * @param [type] $search
     * @return void
     */
    function search_cat($search){
        $this->db = Db::getInstance();
        $query = $this->db->prepare('SELECT * FROM categories WHERE libelle LIKE ? AND LOWER(plats.active) = "1"');
        $query->bindValue(1, "%$search%");
        $query->execute();
        $tab = $query->fetchAll();
        $query->closeCursor();
        return $tab;
    }
    /**
     * function permetant l'ajouts des plats au paniers
     *
     * @param [type] $ids
     * @return void
     */
    public function panier($ids)
{
    $this->db = Db::getInstance();
    //utilisation de rtrim suite a un probleme lors de l'exec pour uprimer des espace a droite apres mon ajouts 
    $tablo = rtrim(str_repeat('?,', count($ids)), ',');
    $query = $this->db->prepare("SELECT * FROM plats WHERE id IN ($tablo)");
    $query->execute($ids);
    return $query->fetchAll();
}
    
    
}


?>