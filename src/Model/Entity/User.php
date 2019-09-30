<?php

namespace App\Model\Entity;

use App\Traits\Users\Getters;
use App\Traits\Users\Setters;
use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property int $role_id
 * @property string $name
 * @property string $slug
 * @property string $email
 * @property string $password
 * @property FrozenTime $created
 *
 */
class User extends Entity
{
    /**
     * user traits.
     */
    use Getters, Setters;

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'role_id' => true,
        'name' => true,
        'slug' => true,
        'email' => true,
        'password' => true,
        'profile_image' => true,
        'created' => true,
        'role' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
