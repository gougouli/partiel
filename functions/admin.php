<?php

function recoverUser($visible = 2){
    $db = dbConnect();
    if($visible == 2){
        $result = $db->query("SELECT * FROM users");
    }else{
        $result = $db->query("SELECT * FROM users WHERE visible = '$visible'");
    }
    return $result->fetchAll(PDO::FETCH_ASSOC);
}

function recoverUserNewLetter(){
    $db = dbConnect();
    $result = $db->query("SELECT * FROM newsletter");
    return $result->fetchAll(PDO::FETCH_ASSOC);
}

function getInfo($id){
    $db = dbConnect();
    $result = $db->prepare("SELECT * FROM users WHERE id = ?");
    $result->execute([$id]);
    return $result->fetch(PDO::FETCH_ASSOC);
}
