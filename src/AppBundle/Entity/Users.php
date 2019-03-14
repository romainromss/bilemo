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
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class Users.
 *
 * @author Romain Bayette <romainromss@posteo.net>
 *
 * @ORM\Entity()
 * @ORM\Table(name="Users")
 */
class Users extends AbstractEntity implements UserInterface
{
    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $username;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $lastname;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $b2b;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $role;

    /**
     * Users constructor.
     *
     * @param string $username
     * @param string $name
     * @param string $lastname
     * @param string $password
     * @param string $email
     * @param string $b2b
     * @param string $role
     *
     * @throws \Exception
     */
    public function __construct(
        string $username,
        string $name,
        string $lastname,
        string $password,
        string $email,
        string $b2b,
        string $role
    )
    {
        $this->username = $username;
        $this->name = $name;
        $this->lastname = $lastname;
        $this->password = $password;
        $this->email = $email;
        $this->b2b = $b2b;
        $this->role = $role;
        parent::__construct();
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
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
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getB2b(): string
    {
        return $this->b2b;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @return array (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    /**
     * @return string|null The salt
     */
    public function getSalt()
    {
        return $this->password;
    }

    public function eraseCredentials()
    {
    }
}
