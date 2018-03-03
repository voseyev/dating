<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 2/28/2018
 * Time: 11:20 PM
 */


require("config.php");

class functions
{
    public static function connect()
    {
        try {
            //Instantiate a database object
            $dbh = new PDO(DB_DSN, DB_USERNAME,
                DB_PASSWORD);
            return $dbh;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return;
        }
    }
    public function addMember($member) {
        $dbh = $this->connect();
        $sql = "INSERT INTO Members (fname,lname,age,gender,phone,email,state,seeking,bio,premium,image,interests)
            VALUES (:first, :last, :age, :gender, :phone, :email, :state, :seeking, :bio, :premium, :image, :interests)";
        if($member instanceof PremiumMember){
            $isPremium = "on";
            $indoor = implode(' ', (array)$member->getIndoorActivities());
            $outdoor = implode(' ', (array)$member->getOutDoorActivities());
            $interests = $indoor .' '. $outdoor;
        } else {
            $isPremium = "off";
        }
        $image = "NULL";
        $statement = $dbh->prepare($sql);
        $statement->bindParam(':first', $member->getFName(), PDO::PARAM_STR);
        $statement->bindParam(':last', $member->getLName(), PDO::PARAM_STR);
        $statement->bindParam(':age', $member->getAge(), PDO::PARAM_STR);
        $statement->bindParam(':gender', $member->getGender(), PDO::PARAM_STR);
        $statement->bindParam(':phone', $member->getPhone(), PDO::PARAM_STR);
        $statement->bindParam(':premium', $isPremium, PDO::PARAM_STR);
        $statement->bindParam(':email', $member->getEmail(), PDO::PARAM_STR);
        $statement->bindParam(':state', $member->getState(), PDO::PARAM_STR);
        $statement->bindParam(':seeking', $member->getSeeking(), PDO::PARAM_STR);
        $statement->bindParam(':bio', $member->getBio(), PDO::PARAM_STR);
        $statement->bindParam(':image', $image, PDO::PARAM_STR);
        $statement->bindParam(':interests', $interests, PDO::PARAM_STR);
        $success = $statement->execute();
        return $success;
    }
    public static function getMembers()
    {
        $dbh = functions::connect();
        $sql = "SELECT * FROM Members ORDER BY lname";
        $statement = $dbh->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}