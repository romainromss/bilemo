<?php
/**
 * Created by PhpStorm.
 * User: romss
 * Date: 2019-03-21
 * Time: 19:56
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Users::class);
    }

    public function getAllUsers()
    {
        return $this->createQueryBuilder('u')
            ->orderBy('u.createdAt', 'DESC')
            ->setCacheable(true)
            ->getQuery()
            ->getResult()
            ;
    }


    public function getUserById($id)
    {
        return$this->createQueryBuilder('u')
            ->where('u.id = :id')
            ->setParameter('id', $id)
            ->setCacheable(true)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    /**
     * @param $input
     *
     * @throws \Doctrine\ORM\ORMException
     */
    public function delete($input)
    {
        $this->_em->remove($input);
    }
}
