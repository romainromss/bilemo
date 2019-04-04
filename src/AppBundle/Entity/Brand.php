<?php
/**
 * Created by PhpStorm.
 * User: romss
 * Date: 2019-03-14
 * Time: 20:13
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;


/**
 * Class Brand
 *
 * @author Romain Bayette <romainromss@posteo.net>
 *
 * @ORM\Entity()
 * @ORM\Table(name="Brand")
 * @Serializer\ExclusionPolicy("all")
 */
class Brand extends AbstractEntity
{
    /**
     * @var string
     *
     * @ORM\Column(type="string")
     *
     * @Serializer\Expose()
     * @Serializer\Groups({"details_phone", "list_phone"})
     */
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
        parent::__construct();
    }
}
