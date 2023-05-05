<?php

use App\Autoloader;
use App\Models\CommandesModel;

require_once "./Autoloader.php";
Autoloader::register();

$id = $_GET['id'];

$deluse =new CommandesModel();

$del = $deluse->delete($id);

TrtRedirection:
    header("Location: ../admin.php");

?>