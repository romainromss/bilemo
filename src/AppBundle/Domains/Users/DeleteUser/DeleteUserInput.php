<?php
/**
 * Created by PhpStorm.
 * User: romss
 * Date: 2019-03-21
 * Time: 19:46
 */

namespace AppBundle\Domains\Users\DeleteUser;

use AppBundle\Entity\Users;

class DeleteUserInput
{
    /**
     * @var Users
     */
    protected $user;

    public function getUser(): Users
    {

        return $this->user;
    }

    public function setUser(Users $users): void {
        $this->user = $users;
    }
}
