<?php

class Config
{
    const SERVERNAME="localhost";
    const DBNAME="urgenceaudb";
    const USER="root";
    const PASSWORD="";

    public static function getDb() {
        mb_internal_encoding('UTF-8');
        return new PDO("mysql:host=".config::SERVERNAME.";dbname=".config::DBNAME,config::USER,config::PASSWORD);
    }

    public static function getUser($id){
        $r = self::getDb()->prepare("select * from user where id =:id");
        $r->bindParam(":id", $id);
        $r->execute();
        return $r->fetch();
    }

    public static function getAllIncident(){
        $r = self::getDb()->prepare("select * from incident");
        $r->execute();
        return $r->fetchAll();
    }

}