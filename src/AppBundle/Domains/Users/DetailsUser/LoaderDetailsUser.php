<?php
/**
 * Created by PhpStorm.
 * User: romss
 * Date: 2019-03-21
 * Time: 19:47
 */

namespace AppBundle\Domains\Users\DetailsUser;

use AppBundle\Domains\AbstractLoader;
use AppBundle\Entity\Users;
use AppBundle\Repository\UserRepository;

class LoaderDetailsUser extends AbstractLoader
{
    public function load(DetailsUserInput $detailsUserInput)
    {
        /** @var UserRepository $repository */
        $repository = $this->getRepository(Users::class);
        $data = $repository->getUserById($detailsUserInput->getUser());

        if (empty($data)) {
            return null;
        }

        return $this->dataFormatted($data, 'details_user');
    }
}
