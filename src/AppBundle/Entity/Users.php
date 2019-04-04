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
use JMS\Serializer\Annotation as Serializer;

/**
 * Class Users.
 *
 * @author Romain Bayette <romainromss@posteo.net>
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\Table(name="Users")
 * @Serializer\ExclusionPolicy("all")
 */
class Users extends AbstractEntity
{
    /**
     * @var string
     * @Serializer\Expose()
     * @Serializer\Groups({"details_user", "list_users"})
     *
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     * @Serializer\Groups({"details_user", "list_users"})
     */
    protected $lastname;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     * @Serializer\Groups({"details_user", "list_users"})
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     * @Serializer\Groups({"details_user", "list_users"})
     */
    protected $cellPhone;

    /**
     * Users constructor.
     *
     * @param string $name
     * @param string $lastname
     * @param string $email
     * @param string $cellPhone
     *
     * @throws \Exception
     */
    public function __construct(
        string $name,
        string $lastname,
        string $email,
        string $cellPhone
    )
    {
        $this->name = $name;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->cellPhone = $cellPhone;
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
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCellPhone(): string
    {
        return $this->cellPhone;
    }
}
