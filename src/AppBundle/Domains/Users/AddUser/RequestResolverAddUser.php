<?php
/**
 * Created by PhpStorm.
 * User: romss
 * Date: 2019-03-21
 * Time: 18:20
 */

namespace AppBundle\Domains\Users\AddUser;


use AppBundle\Domains\AbstractRequestResolver;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\SerializerInterface;

class RequestResolverAddUser extends AbstractRequestResolver
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(
        EntityManagerInterface $entityManager,
        TokenStorageInterface $tokenStorage,
        SerializerInterface $serializer
    ) {
        $this->entityManager = $entityManager;
        $this->tokenStorage = $tokenStorage;
        $this->serializer = $serializer;
    }

    /**
     * @param Request $request
     *
     * @return InputInterface|null
     *
     * @throws \ReflectionException
     */
    public function resolver(Request $request)
    {
       $client = $this->tokenStorage->getToken()->getUser();
       /** @var AddUserInput $input */
       $input = $this->serializer->deserialize($request->getContent(), $this->getInputClassName(), 'json');
       $input->setClient($client);
       return $input;
    }

    /**
     * @return string
     */
    protected function getInputClassName(): string
    {
        return AddUserInput::class;
    }
}
