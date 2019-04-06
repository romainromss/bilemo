<?php
/**
 * Created by PhpStorm.
 * User: romss
 * Date: 2019-03-21
 * Time: 19:46
 */

namespace AppBundle\Domains\Users\DeleteUser;

use AppBundle\Domains\AbstractRequestResolver;
use AppBundle\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Security\Core\Security;

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
   * @var Security
   */
  private $security;
  
  /**
   * RequestResolverDeleteUser constructor.
   *
   * @param EntityManagerInterface $entityManager
   * @param UserRepository         $userRepository
   * @param Security               $security
   */
  public function __construct(
    EntityManagerInterface $entityManager,
    UserRepository $userRepository,
    Security $security
  ) {
    $this->entityManager = $entityManager;
    $this->userRepository = $userRepository;
    $this->security = $security;
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
    $clientId = $request->attributes->get('id_client');
    $idUser = $request->attributes->get('id_user');
    
    if( !$this->security->isGranted('', $clientId)) {
      throw new AccessDeniedHttpException(
        'vous ne pouvez pas supprimer cet utilisateur'
      );
    }
    
    $user = $this->userRepository->getUserById($idUser);
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
