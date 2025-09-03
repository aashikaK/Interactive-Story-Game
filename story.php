<?php
require "db.php";
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location:login.php");
    exit;
}

$story_id=isset($_GET['story_id'])?$_GET['story_id']:1;
$node_id= isset($_GET['node'])?$_GET['node']: null;

if($node_id){
    $stmt=$pdo->prepare("SELECT * FROM story_nodes WHERE story_id=? AND id=?");

}