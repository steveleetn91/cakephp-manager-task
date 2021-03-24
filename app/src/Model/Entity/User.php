<?php
namespace App\Model\Entity;

use Authentication\PasswordHasher\DefaultPasswordHasher; // Add this line
use Cake\ORM\Entity;

class User extends Entity
{
    // Code from bake.

    // Add this method
    protected function _setPassword(string $password)
    {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($password);
    }
}