<?php
/**
 * Created by PhpStorm.
 * User: romss
 * Date: 2019-03-14
 * Time: 18:29
 */

namespace AppBundle\Domains\Phones\ListPhones;


use AppBundle\Domains\AbstractRequestResolver;
use Doctrine\ORM\EntityManagerInterface;
use ReflectionException;
use Symfony\Component\HttpFoundation\Request;

class RequestResolverListPhone extends AbstractRequestResolver
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
     * @throws ReflectionException
     */
    public function resolver(Request $request)
    {
        $input = $this->instanciateInputClass();
        return $input;
    }

    protected function getInputclassName(): string
    {
        return ListPhoneInput::class;
    }
}
