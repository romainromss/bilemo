<?php
/**
 * Created by PhpStorm.
 * User: romss
 * Date: 2019-03-13
 * Time: 19:05
 */

namespace AppBundle\Domains\Phones\DetailsPhone;


use AppBundle\Domains\AbstractRequestResolver;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class RequestResolverDetailsPhone extends AbstractRequestResolver
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
        $input->setPhone($request->attributes->get('id'));

        return $input;
    }

    protected function getInputclassName(): string
    {
        return DetailsPhoneInput::class;
    }
}
