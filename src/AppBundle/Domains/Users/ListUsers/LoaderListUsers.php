<?php
/**
 * Created by PhpStorm.
 * User: romss
 * Date: 2019-03-21
 * Time: 19:48
 */

namespace AppBundle\Domains\Users\ListUsers;


use AppBundle\Domains\AbstractLoader;
use AppBundle\Entity\Users;
use AppBundle\Repository\UserRepository;

class LoaderListUsers extends AbstractLoader
{
    /**
     * @return string|null
     */
    public function load()
    {
        /** @var  UserRepository $repository */
        $repository = $this->getRepository(Users::class);
        $data = $repository->getAllUsers();

        if (empty($data)) {
            return null;
        }

        return $this->dataFormatted($data, 'list_users');
    }
}
