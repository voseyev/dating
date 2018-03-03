<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 2/28/2018
 * Time: 11:20 PM
 */


require("config.php");

/*
 * member_id primary key int(11) Auto_Increment
 * fname varchar(45)	latin1_swedish_ci		No	None
 * lname varchar(45)	latin1_swedish_ci		No	None
 * age int(2)                                   Yes Null
 * gender varchar(10)	latin1_swedish_ci		Yes	Null
 * phone gender int(11)	latin1_swedish_ci		Yes	Null
 * gender varchar(45)	latin1_swedish_ci		Yes Null
 * state varchar(45)	latin1_swedish_ci		Yes	Null
 * seeking varchar(15)	latin1_swedish_ci		Yes	Null
 * bio text	            latin1_swedish_ci       Yes	Null
 * premium tinyint(1)	latin1_swedish_ci		Yes	Null
 * image varchar(45)	latin1_swedish_ci		Yes	None
 * interests varchar(100)	latin1_swedish_ci	Yes	Null
 */

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