<?php

use App\Autoloader;
use App\Models\UtilisateursModel;

require_once "../Autoloader.php";
Autoloader::register();

$id = $_GET['id'];

$deluse =new UtilisateursModel();

$del = $deluse->delete($id);

header("Location: ../../content/admin/admin.php");

?>