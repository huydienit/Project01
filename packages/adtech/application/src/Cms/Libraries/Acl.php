<?php

namespace Adtech\Application\Cms\Libraries;

use \Adtech\Core\App\Models\Acl as AclModel;
use \Adtech\Core\App\Models\User;
use \Adtech\Core\App\Models\Role;
use Auth;

class Acl
{
    /**
     * @var \Adtech\Application\Cms\Libraries\Acl
     */
    private static $_instance = null;

    private $_user = null;

    private $_rules = null;

    private $_superAdministratorId = 1;

    /**
     * @return \Adtech\Application\Cms\Libraries\Acl
     */
    public static function getInstance()
    {
        if (null == self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function __construct()
    {
        $this->_user = Auth::user();

        if ($this->_user) {
            $roles = $this->_user->roles;
            $role = $roles ? $roles[0] : null;

            $this->_user->role_id = $role->role_id;
        }

        $this->_rules = AclModel::getAllRules();
    }

    /**
     * @param $id
     * @return $this
     */
    public function setSuperAdministratorId($id)
    {
        $this->_superAdministratorId = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getSuperAdministratorId()
    {
        return $this->_superAdministratorId;
    }

    /**
     * @param $routeName
     * @param $params
     * @param Adtech\Core\App\Models\User|Adtech\Core\App\Models\Role
     * @return bool
     */
    public function isAllow($routeName, $params = null, $object = null)
    {
        if (null == $object && null == $this->_user) {
            return false;
        }
        /** check super administrator **/
        if (null == $object && $this->_user->role_id == $this->_superAdministratorId) {
            return true;
        } elseif ($object != null
            && ($object instanceof \Adtech\Core\App\Models\User || $object instanceof \Adtech\Core\App\Models\Role))
        {
            $roleId = $object instanceof \Adtech\Core\App\Models\User && isset($object->roles[0]) ? $object->roles[0]->role_id : $object->role_id;
            if ($roleId == $this->_superAdministratorId) {
                return true;
            }
        }

        if ($this->_rules) {
            $roleId = isset($this->_user->role_id) ? $this->_user->role_id : null;
            $roleName = 'role_' . $roleId;
            if ($object && ($object instanceof \Adtech\Core\App\Models\User || $object instanceof \Adtech\Core\App\Models\Role)) {
                $roleId = $object instanceof \Adtech\Core\App\Models\User && isset($object->roles[0]) ? $object->roles[0]->role_id : $object->role_id;
                $roleName = 'role_' . $roleId;
            }

            $userId = isset($this->_user->user_id) ? $this->_user->user_id : null;
            $userRoleName = 'user_' . $userId;
            if ($object && $object instanceof User) {
                $userRoleName = 'user_' . $object->user_id;
            }

            $pattern = (object)array(
                'role_name' => $roleName,
                'allow' => 0,
                'route_name' => $routeName,
            );
            $userPattern = (object)array(
                'role_name' => $userRoleName,
                'allow' => 0,
                'route_name' => $routeName,
            );
            $rules = $this->_rules;

            if ((in_array($pattern, $rules) && in_array($userPattern, $rules))
                || (!in_array($pattern, $rules) && in_array($userPattern, $rules))
            ) {
                return false;
            } elseif (in_array($pattern, $rules)) {
                $userPattern->allow = 1;
                if (in_array($userPattern, $rules)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                $pattern->allow = 1;
                $userPattern->allow = 1;

                if (in_array($pattern, $rules) || in_array($userPattern, $rules)) {
                    return true;
                } else {
                    $pattern->route_name = null;
                    $userPattern->route_name = null;

                    if (in_array($pattern, $rules) || in_array($userPattern, $rules)) {
                        return true;
                    }
                }
            }
        }
        return false;
    }
}
