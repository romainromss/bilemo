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


use Ramsey\Uuid\UuidInterface;

trait IdTrait
{
    /**
     * @var UuidInterface
     *
     * @ORM\Column(type='uuid')
     */
    protected $id;

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }
}
