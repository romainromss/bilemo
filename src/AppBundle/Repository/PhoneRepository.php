<?php
declare(strict_types=1);

/*
 * This file is part of the Bilemo project.
 *
 * (c) Romain Bayette <romainromss@posteo.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Phone;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class PhoneRepository.
 *
 * @author Romain Bayette <romainromss@posteo.net>
 */
class PhoneRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Phone::class);
    }


    public function getAllPhones()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.createdAt', 'DESC')
            ->setCacheable(true)
            ->getQuery()
            ->getResult()
            ;
    }


    public function getPhoneById($id)
    {
        return$this->createQueryBuilder('p')
        ->where('p.id = :id')
        ->setParameter('id', $id)
        ->setCacheable(true)
        ->getQuery()
        ->getResult()
        ;
    }
}