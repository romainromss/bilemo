<?php
/**
 * Created by PhpStorm.
 * User: romss
 * Date: 2019-03-21
 * Time: 19:48
 */

namespace AppBundle\Domains\Users\ListUsers;


use AppBundle\Domains\AbstractLoader;
use AppBundle\Domains\Security\ClientVoter;
use AppBundle\Entity\Users;
use AppBundle\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class LoaderListUsers extends AbstractLoader
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;



    public function __construct(
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer,
        AuthorizationCheckerInterface $authorizationChecker,
        TokenStorageInterface $tokenStorage

    ) {
        parent::__construct($entityManager, $serializer);
        $this->entityManager = $entityManager;
        $this->authorizationChecker = $authorizationChecker;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param Request $request
     *
     * @return string|null
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function load(Request $request)
    {
        $clientId = $request->attributes->get('client_id');

        /** @var  UserRepository $repository */
        $repository = $this->getRepository(Users::class);
        $data = $repository->getUsersFromClient($clientId);

        if(!$this->authorizationChecker->isGranted(ClientVoter::CLIENT_VOTER, $clientId)) {
            throw new AccessDeniedHttpException(
                'vous ne pouvez pas consulter les utilisateurs'
            );
        }

        if (empty($data)) {
            return null;
        }
        return $this->dataFormatted($data, 'list_users');
    }
}
