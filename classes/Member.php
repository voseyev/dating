<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 2/13/2018
 * Time: 10:25 AM
 */

class Member
{
    protected $fname;
    protected $lname;
    protected $age;
    protected $gender;
    protected $phone;
    protected $email;
    protected $state;
    protected $seeking;
    protected $bio;

    /**
     * Member constructor.
     * @param $fname first name of user
     * @param $lname last name of user
     * @param $age age of user
     * @param $gender gender of user
     * @param $phone phone number of user
     */

    public function __construct($fname, $lname, $age, $gender, $phone)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->age = $age;
        $this->gender = $gender;
        $this->phone = $phone;
    }
    //Setters & Getters
    /**
     * Sets the first name of the user
     * @param first name
     */
    function setFname($fname)
    {
        $this->fname = $fname;
    }
    /**
     * @return first name of user
     */
    function getFName()
    {
        return $this->fname;
    }
    /**
     * Sets the last name of the user
     * @param last name
     */
    function setLName($lname)
    {
        $this->lname = $lname;
    }
    /**
     * @return last name of user
     */
    function getLName()
    {
        return $this->lname;
    }
    /**
     * Sets the age of the user
     * @param age of user
     */
    function setAge($age)
    {
        $this->age = $age;
    }
    /**
     * @return age of user
     */
    function getAge()
    {
        return $this->age;
    }
    /**
     * Sets the gender of the user
     * @param gender of user
     */
    function setGender($gender)
    {
        $this->gender = $gender;
    }
    /**
     * @return gender of user
     */
    function getGender()
    {
        return $this->gender;
    }
    /**
     * Sets the phone number of the user
     * @param $phone phone number of user
     */
    function setPhone($phone)
    {
        $this->phone = $phone;
    }
    /**
     * @return phone number of user
     */
    function getPhone()
    {
        return $this->phone;
    }
    /**
     * Sets the email of the user
     * @param $email email of user
     */
    function setEmail($email)
    {
        $this->email = $email;
    }
    /**
     * @return email of user
     */
    function getEmail()
    {
        return $this->email;
    }
    /**
     * Sets the state location of user
     * @param state
     */
    function setState($state)
    {
        $this->state = $state;
    }
    /** Gets state of the user
     * @return state
     */
    function getState()
    {
        return $this->state;
    }
    /**
     * Set what gender the user is seeking
     * @param gender user is seeking
     */
    function setSeeking($seeking)
    {
        $this->seeking = $seeking;
    }
    /**
     * @return gender user is seeking
     */
    function getSeeking()
    {
        return $this->seeking;
    }
    /**
     * Sets the biography of the user
     * @param biography of user
     */
    function setBio($bio)
    {
        $this->bio = $bio;
    }
    /**
     * @return biography of user
     */
    function getBio()
    {
        return $this->bio;
    }
}