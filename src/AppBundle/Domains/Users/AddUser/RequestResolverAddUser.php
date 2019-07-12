<?php
/**
 * Created by PhpStorm.
 * User: romss
 * Date: 2019-03-21
 * Time: 18:20
 */

namespace AppBundle\Domains\Users\AddUser;

use AppBundle\Domains\AbstractRequestResolver;
use AppBundle\Domains\Security\ClientVoter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Security;
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

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    public function __construct(
        EntityManagerInterface $entityManager,
        TokenStorageInterface $tokenStorage,
        SerializerInterface $serializer,
        AuthorizationCheckerInterface $authorizationChecker
    ) {
        $this->entityManager = $entityManager;
        $this->tokenStorage = $tokenStorage;
        $this->serializer = $serializer;
        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     * @param Request $request
     *
     * @return AddUserInput
     *
     */
    public function resolver(Request $request)
    {
        $client = $this->tokenStorage->getToken()->getUser();
        $clientId = $request->attributes->get('client_id');


        if(!$this->authorizationChecker->isGranted(ClientVoter::CLIENT_VOTER, $clientId)) {
            throw new AccessDeniedHttpException(
                'vous ne pouvez pas ajouter cet utilisateur'
            );
        }

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
