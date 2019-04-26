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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class Phone.
 *
 * @author Romain Bayette <romainromss@posteo.net>
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PhoneRepository")
 * @ORM\Table(name="Phone")
 * @Serializer\ExclusionPolicy("all")
 */
class Phone extends AbstractEntity
{
    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     * @Serializer\Groups({"details_phone", "list_phone"})
     */
    protected $name;

    /**
     * @ORM\Column(type="text")
     * @Serializer\Expose()
     * @Serializer\Groups({"details_phone", "list_phone"})
     */
    protected $description;

    /**
     * @var ArrayCollection
     *
     * @Serializer\Expose()
     * @Serializer\Groups({"details_phone", "list_phone"})
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Memory", cascade={"persist"})
     * @ORM\JoinTable(name="phone_memory",
     *     joinColumns={@ORM\JoinColumn(referencedColumnName="id", name="phone_id")},
     *     inverseJoinColumns={@ORM\JoinColumn(referencedColumnName="id", name="memory_id")}
     *     )
     */
    protected $memory;

    /**
     * @var
     *
     * @Serializer\Expose()
     * @Serializer\Groups({"details_phone", "list_phone"})
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Brand", cascade={"persist"})
     */
    protected $brand;

    /**
     * @var Os
     *
     * @Serializer\Expose()
     * @Serializer\Groups({"details_phone", "list_phone"})
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Os", cascade={"persist"})
     */
    protected $os;

    /**
     * Phone constructor.
     *
     * @param string $name
     * @param string $description
     * @param array $memories
     * @param Brand $brand
     * @param Os $os
     *
     * @throws \Exception
     */
    public function __construct(
        string $name,
        string $description,
        array $memories,
        Brand $brand,
        Os $os
    ) {
        $this->name = $name;
        $this->description = $description;
        $this->memory = new ArrayCollection($memories);
        $this->brand = $brand;
        $this->os = $os;
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

    /**
     * @return \ArrayAccess
     */
    public function getMemory()
    {
        return $this->memory;
    }

    /**
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @return Os
     */
    public function getOs(): Os
    {
        return $this->os;
    }
}
