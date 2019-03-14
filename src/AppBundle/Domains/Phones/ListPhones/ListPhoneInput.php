<?php
/**
 * Created by PhpStorm.
 * User: romss
 * Date: 2019-03-14
 * Time: 18:28
 */

namespace AppBundle\Domains\Phones\ListPhones;


class ListPhoneInput
{
    /**
     * @var string | null
     */
    protected $phone;

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    public function getPhone(): ? string
    {
        return $this->phone;
    }
}
