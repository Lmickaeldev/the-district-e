<?php

use App\Autoloader;
use App\Models\CategoriesModel;

require_once "../../Autoloader.php";
Autoloader::register();

$id = $_GET['id'];

$deluse =new CategoriesModel();

$del = $deluse->delete($id);

TrtRedirection:
    header("Location: ../../content/admin/admin.php");

?>