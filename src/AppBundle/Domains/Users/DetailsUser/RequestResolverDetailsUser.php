<?php
/**
 * Created by PhpStorm.
 * User: romss
 * Date: 2019-03-21
 * Time: 19:48
 */

namespace AppBundle\Domains\Users\DetailsUser;

use AppBundle\Domains\AbstractRequestResolver;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Security\Core\Security;

class RequestResolverDetailsUser extends AbstractRequestResolver
{
  /**
   * @var EntityManagerInterface
   */
  protected $entityManager;
  /**
   * @var Security
   */
  private $security;
  
  public function __construct(
    EntityManagerInterface $entityManager,
    Security $security
  ) {
    $this->entityManager = $entityManager;
    $this->security = $security;
  }
  
  /**
   * @param Request $request
   *
   * @return mixed
   *
   * @throws \ReflectionException
   */
  public function resolver(Request $request)
  {
    $clientId = $request->attributes->get('client_id');
    
    if( !$this->security->isGranted('', $clientId)) {
      throw new AccessDeniedHttpException(
        'vous ne pouvez pas consulter cet utilisateur'
      );
    }
    
    $input = $this->instanciateInputClass();
    $input->setClient($clientId);
    $input->setUser($request->attributes->get('user_id'));
    
    return $input;
  }
  
  /**
   * @return string
   */
  protected function getInputclassName(): string
  {
    return DetailsUserInput::class;
  }
}
