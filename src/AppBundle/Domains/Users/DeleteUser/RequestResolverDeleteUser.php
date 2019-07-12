<?php
/**
 * Created by PhpStorm.
 * User: romss
 * Date: 2019-03-21
 * Time: 19:46
 */

namespace AppBundle\Domains\Users\DeleteUser;

use AppBundle\Domains\AbstractRequestResolver;
use AppBundle\Domains\Security\ClientVoter;
use AppBundle\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;


class RequestResolverDeleteUser extends AbstractRequestResolver
{
  /**
   * @var EntityManagerInterface
   */
  protected $entityManager;

  /**
   * @var UserRepository
   */
  private $userRepository;

  /**
   * @var AuthorizationCheckerInterface
   */
  private $authorizationChecker;
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * RequestResolverDeleteUser constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param UserRepository $userRepository
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param TokenStorageInterface $tokenStorage
     */
  public function __construct(
    EntityManagerInterface $entityManager,
    UserRepository $userRepository,
    AuthorizationCheckerInterface $authorizationChecker,
    TokenStorageInterface $tokenStorage
  ) {
    $this->entityManager = $entityManager;
    $this->userRepository = $userRepository;
    $this->authorizationChecker = $authorizationChecker;
    $this->tokenStorage = $tokenStorage;
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

    $userId = $request->attributes->get('user_id');
    $userExist = $this->userRepository->userExist($userId);

    if ($userExist == null) {
        throw new NotFoundHttpException(
          'cet utilisateur n\'existe pas'
        );
    }

    if($userExist->getClient() != $client && !$this->authorizationChecker->isGranted(ClientVoter::CLIENT_VOTER, $client)) {
        throw new AccessDeniedHttpException(
        'vous ne pouvez pas supprimer cet utilisateur'
      );
    }

    $user = $this->userRepository->getUserById($userId);
    $input = $this->instanciateInputClass();
    $input->setUser($user);
    return $input;
  }

  /**
   * @return string
   */
  protected function getInputClassName(): string
  {
    return DeleteUserInput::class;
  }
}
