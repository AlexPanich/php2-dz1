<?php

namespace App\Models;


use App\Model;

/**
 * Class User
 * @package App\Models
 */
class User extends Model
{
    const TABLE = 'users';

    protected $email;
    protected $name;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }


}