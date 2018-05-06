<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * User Entity
 *
 * @property int $id
 * @property int $role_id
 * @property string $name
 * @property string $slug
 * @property string $email
 * @property string $password
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\Role $role
 */
class User extends Entity
{

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
        'created' => true,
        'role' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    /**
     * @param $password
     * @return mixed
     */
    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }

    protected function _getActions()
    {
        return $this->_edit() . $this->_delete();
    }

    private function _edit()
    {
        return '<a class="btn-info btn-xs" href="/admin/users/edit/'. $this->_properties['slug'] .'" title="Edit user" ><i class="lnr lnr-pencil" ></i></a>';
    }

    private function _delete()
    {
        return '<a class="btn-danger btn-xs delete-user" style="cursor: pointer; margin-left:5px;" data-path="/api/users/delete/'. $this->_properties['id'] .'" title="Delete user" ><i class="lnr lnr-trash" ></i></a>';
    }
}
