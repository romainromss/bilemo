<?php
/**
 * Created by PhpStorm.
 * User: romss
 * Date: 2019-03-13
 * Time: 21:31
 */

namespace AppBundle\Domains;


use ReflectionClass;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractRequestResolver
{
    /**
     * @param Request $request
     *
     * @return InputInterface|null
     */
    abstract public function resolver(Request $request);
    /**
     * @return string
     */
    abstract protected function getInputClassName(): string;

    /**
     * @return mixed
     *
     * @throws \ReflectionException
     */
    protected function instanciateInputClass()
    {
        $reflectClass = new ReflectionClass($this->getInputClassName());
        $class = $reflectClass->name;
        return new $class();
    }
}