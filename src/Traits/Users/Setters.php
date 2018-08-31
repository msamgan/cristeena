<?php
namespace App\Traits\Users;

use Cake\Auth\DefaultPasswordHasher;

/**
 * Trait Setters
 * @package App\Traits\Users
 */
trait Setters {
    /**
     * @param $password
     * @return bool|string
     */
    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }
}
