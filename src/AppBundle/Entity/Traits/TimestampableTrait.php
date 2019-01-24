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

namespace AppBundle\Entity\Traits;


trait TimestampableTrait
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(type='datetime)
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type='datetime')
     */
    protected $updatedAt;

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }
}
