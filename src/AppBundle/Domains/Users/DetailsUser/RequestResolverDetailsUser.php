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

class RequestResolverDetailsUser extends AbstractRequestResolver
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
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
        $input = $this->instanciateInputClass();
        $input->setClient($request->attributes->get('client_id'));
        $input->setUser($request->attributes->get('user_id'));

        return $input;
    }

    protected function getInputclassName(): string
    {
        return DetailsUserInput::class;
    }
}
