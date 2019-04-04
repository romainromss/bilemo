<?php
/**
 * Created by PhpStorm.
 * User: romss
 * Date: 2019-03-21
 * Time: 18:55
 */

namespace AppBundle\Domains\Users\AddUser;

use AppBundle\Domains\AbstractLoader;
use AppBundle\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class LoaderAddUser extends AbstractLoader
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

    public function load(AddUserInput $addUserInput)
    {
        $user = new  Users(
            $addUserInput->getName(),
            $addUserInput->getLastname(),
            $addUserInput->getAdress(),
            $addUserInput->getEmail()
        );
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return ['Location' => $this->urlGenerator->generate('add_user', ['client_id' => $addUserInput->getClient()->getId()->toString(), 'user_id' => $user->getId()])];
    }
}
