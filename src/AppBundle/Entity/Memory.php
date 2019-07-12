<?php
/**
 * Created by PhpStorm.
 * User: romss
 * Date: 2019-03-14
 * Time: 21:36
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class Memory
 *
 * @author Romain Bayette <romainromss@posteo.net>
 *
 * @ORM\Entity()
 * @ORM\Table(name="bilemo_memory")
 * @Serializer\ExclusionPolicy("all")
 */
class Memory extends AbstractEntity
{

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     * @Serializer\Groups({"details_phone", "list_phone"})
     */
    private $name;

    public function __construct($name)
    {
        $this->id = Uuid::uuid4();
        $this->name = $name;
        parent::__construct();
    }
}
