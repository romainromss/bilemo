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

namespace AppBundle\Domains\Phones\DetailsPhone;

use AppBundle\Domains\AbstractLoader;
use AppBundle\Entity\Phone;
use AppBundle\Repository\PhoneRepository;

/**
 * Class LoaderDetailPhone.
 *
 * @author Romain Bayette <romainromss@posteo.net>
 */
class LoaderDetailPhone extends AbstractLoader
{
    public function load(DetailsPhoneInput $detailsPhoneInput)
    {
        /** @var PhoneRepository $repository */
        $repository = $this->getRepository(Phone::class);
        $data = $repository->getPhoneById($detailsPhoneInput->getPhone());

        if (empty($data)) {
            return null;
        }

        return $this->dataFormatted($data, 'details_phone');
    }
}
