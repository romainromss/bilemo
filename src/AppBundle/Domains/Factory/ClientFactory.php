<?php
/**
 * Created by PhpStorm.
 * User: romss
 * Date: 2019-04-17
 * Time: 19:32
 */

namespace AppBundle\Domains\Factory;

use AppBundle\Entity\Client;

class ClientFactory
{
    /**
     * @param string $username
     * @param string $name
     * @param string $lastname
     * @param string $password
     *
     * @param string $email
     * @param string $b2b
     * @return Client
     * @throws \Exception
     */
    public static function create(
        string $username,
        string $name,
        string $lastname,
        string $email,
        string $b2b,
        string $password

    ): Client {
        return new Client($username, $name, $lastname, $password, $email, $b2b);
    }
}
