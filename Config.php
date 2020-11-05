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
    public static function getAllUnrepairedIncident(){
        $r = self::getDb()->prepare("select * from incident where etat !='2' ");
        $r->execute();
        return $r->fetchAll();
    }

    public static function getAllIncidentFromDepartement($id){
        $r = self::getDb()->prepare("select * from incident where departement_id=:id");
        $r->bindParam(":id", $id);
        $r->execute();
        $r->fetchAll();
        return $r->rowCount();
    }

    public static function getAllIncidentFromRegion($id){
        $r = self::getDb()->prepare("select * from incident where departement_id in (select id from departement where region_id=:id)");
        $r->bindParam(":id", $id);
        $r->execute();
        $r->fetchAll();
        return $r->rowCount();

    }

    public static function getAllRepairedIncidentFromDepartement($id){
        $r = self::getDb()->prepare("select * from incident where departement_id=:id AND etat ='2'");
        $r->bindParam(":id", $id);
        $r->execute();
        $r->fetchAll();
        return $r->rowCount();
    }

    public static function getAllRepairedIncidentFromRegion($id){
        $r = self::getDb()->prepare("select * from incident where departement_id in (select id from departement where region_id=:id) and etat ='2'");
        $r->bindParam(":id", $id);
        $r->execute();
        $r->fetchAll();
        return $r->rowCount();

    }

    public static function getAllDepartement($id){
        $r = self::getDb()->prepare("select * from departement where region_id=:id");
        $r->bindParam(":id", $id);
        $r->execute();
        return $r->fetchAll();
    }
    public static function getAllRegion(){
        $r = self::getDb()->prepare("select * from region");
        $r->execute();
        return $r->fetchAll();
    }

    public static function getAllIncidentByDepartement(){

    }

}