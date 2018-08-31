<?php
namespace App\Traits\Users;

/**
 * Trait Getters
 * @package App\Traits\Users
 */
trait Getters {
    /**
     * @return string
     */
    protected function _getDirectorAdminActions()
    {
        return $this->_directorEditAdmin(). $this->_delete();
    }

    /**
     * @return string
     */
    protected function _getDirectorUserActions()
    {
        return $this->_directorEditUser(). $this->_delete();
    }

    /**
     * @return string
     */
    protected function _getAdminUserActions()
    {
        return $this->_adminEdit() . $this->_delete();
    }

    /**
     * @return string
     */
    private function _adminEdit()
    {
        return '<a class="btn-info btn-xs" href="/admin/users/edit/' . $this->_properties['slug'] .'" title="Edit user" ><i class="lnr lnr-pencil" ></i></a>';
    }

    /**
     * @return string
     */
    private function _directorEditAdmin()
    {
        return '<a class="btn-info btn-xs" href="/director/admins/edit/' . $this->_properties['slug'] .'" title="Edit user" ><i class="lnr lnr-pencil" ></i></a>';
    }

    /**
     * @return string
     */
    private function _directorEditUser()
    {
        return '<a class="btn-info btn-xs" href="/director/users/edit/' . $this->_properties['slug'] .'" title="Edit user" ><i class="lnr lnr-pencil" ></i></a>';
    }

    /**
     * @return string
     */
    private function _delete()
    {
        return '<a class="btn-danger btn-xs delete-user" style="cursor: pointer; margin-left:5px;" data-path="/api/users/delete/' . $this->_properties['id'] .'" title="Delete user" ><i class="lnr lnr-trash" ></i></a>';
    }
}
