<?php
/**
 * Created by PhpStorm.
 * User: romss
 * Date: 2019-03-21
 * Time: 19:47
 */

namespace AppBundle\Domains\Users\DetailsUser;


class DetailsUserInput
{
    /**
     * @var string | null
     */
    protected $user;

    /**
     * @var string
     */
    protected $client;

    public function setUser(?string $user): void
    {
        $this->user = $user;
    }

    public function getUser(): ? string
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getClient(): string
    {
        return $this->client;
    }

    /**
     * @param string $client
     */
    public function setClient(string $client): void
    {
        $this->client = $client;
    }
}
