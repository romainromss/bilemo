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
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

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

    public function __construct(
        EntityManagerInterface $entityManager,
        UserRepository $userRepository
    ) {
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
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
        //$idClient = $request->attributes->get('id_client')
        $idUser = $request->attributes->get('id_user');

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
