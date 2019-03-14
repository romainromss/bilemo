<?php
declare(strict_types=1);

/*
 * This file is part of the Bilemo project.
 *
 * (c) Romain Bayette <romainromss@posteo.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Domains\Phones\ListPhones;

use AppBundle\Domains\AbstractLoader;
use AppBundle\Entity\Phone;
use AppBundle\Repository\PhoneRepository;

/**
 * Class LoaderPhoneList.
 *
 * @author Romain Bayette <romainromss@posteo.net>
 */
class LoaderPhoneList extends AbstractLoader
{
    /**
     * @return string|null
     */
    public function load()
    {
        /** @var PhoneRepository $repository */
        $repository = $this->getRepository(Phone::class);
        $data = $repository->getAllPhones();

        if (empty($data)) {
            return null;
        }

        return $this->dataFormatted($data);
    }
}
