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

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\IdTrait;
use AppBundle\Entity\Traits\TimestampableTrait;
use Ramsey\Uuid\Uuid;

/**
 * Class AbstractEntity.
 *
 * @author Romain Bayette <romainromss@posteo.net>
 */
abstract class AbstractEntity
{
    use IdTrait;
    use TimestampableTrait;

    /**
     * AbstractEntity constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
    }

    /**
     * @throws \Exception
     */
    public function onPersist()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @throws \Exception
     */
    public function onUpdate()
    {
        $this->updatedAt = new \DateTime();
    }
}
