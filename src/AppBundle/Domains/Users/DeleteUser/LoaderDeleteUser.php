<?php
/**
 * Created by PhpStorm.
 * User: romss
 * Date: 2019-03-21
 * Time: 19:46
 */

namespace AppBundle\Domains\Users\DeleteUser;

use AppBundle\Domains\AbstractLoader;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class LoaderDeleteUser extends AbstractLoader
{

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    public function __construct(
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer,
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->urlGenerator = $urlGenerator;
        parent::__construct($entityManager, $serializer);
    }

    /**
     * @param DeleteUserInput $deleteUserInput
     *
     * @return array
     */
    public function load(DeleteUserInput $deleteUserInput)
    {
        $user = $deleteUserInput->getUser();
        $this->entityManager->remove($user);
        $this->entityManager->flush();

        return [];
    }
}
