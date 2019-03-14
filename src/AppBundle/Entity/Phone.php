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

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class Phone.
 *
 * @author Romain Bayette <romainromss@posteo.net>
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PhoneRepository")
 * @ORM\Table(name="Phone")
 */
class Phone extends AbstractEntity
{
    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Groups({"list_phone"})
     */
    protected $name;

    /**
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * Phone constructor.
     *
     * @param string $name
     * @param string $description
     *
     * @throws \Exception
     */
    public function __construct(
        string $name,
        string $description
    ) {
        $this->name = $name;
        $this->description = $description;
        parent::__construct();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}
