<?php
/**
 * Created by PhpStorm.
 * User: romss
 * Date: 2019-03-13
 * Time: 20:27
 */

namespace AppBundle\Domains\Phones\DetailsPhone;

class DetailsPhoneInput
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
