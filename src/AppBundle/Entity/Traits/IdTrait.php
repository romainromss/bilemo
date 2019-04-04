<?php

declare(strict_types=1);

/*
 * This file is part of the Bilemo project.
 *
 * (c) Romain Bayette <romain.romss@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Entity\Traits;

use JMS\Serializer\Annotation as Serializer;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait IdTrait
 *
 * @author Romain Bayette <romainromss@posteo.net>
 */
trait IdTrait
{
    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(type="uuid")
     * @Serializer\Groups({"list_phone"})
     */
    protected $id;

    /**
     * @return string
     *
     */
    public function getId()
    {
        return $this->id;
    }
}
