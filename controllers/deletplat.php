<?php

use App\Autoloader;
use App\Models\PlatsModel;

require_once "../../Autoloader.php";
Autoloader::register();

$id = $_GET['id'];

$deluse =new PlatsModel();

$del = $deluse->delete($id);

TrtRedirection:
header("Location: ../../content/admin/admin.php");

?>