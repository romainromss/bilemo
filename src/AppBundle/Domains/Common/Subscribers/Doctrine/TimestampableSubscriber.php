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

namespace AppBundle\Domains\Common\Subscribers\Doctrine;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

/**
 * Class TimestampableSubscriber.
 *
 * @author Romain Bayette <romainromss@posteo.net>
 */
class TimestampableSubscriber implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return [
            Events::prePersist,
            Events::preUpdate
        ];
    }
    public function prePersist(LifecycleEventArgs $eventArgs)
    {
        $eventArgs->getObject()->onPersist();
    }

    public function onUpdate(LifecycleEventArgs $eventArgs)
    {
        $eventArgs->getObject()->onUpdate();
    }
}
