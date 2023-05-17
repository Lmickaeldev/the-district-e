<?php
namespace App\Models;

use App\Models\Model;

class PanierModel extends Model{

    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier']=array();
        }
    }
    

    public function add($cmd)
    {   if (isset($_SESSION['panier'][$cmd['id']])) {
        $_SESSION['panier'][$cmd['id']]++;
    }else{
        $_SESSION['panier'][$cmd['id']] = 1;
    }
    }    

    public function del($product_id)
    {
        unset($_SESSION['panier'][$product_id]);
    }
}