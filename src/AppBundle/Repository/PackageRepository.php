<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * PackageRepository
 *
 * This class was generated by the PhpStorm "Php Annotations" Plugin. Add your own custom
 * repository methods below.
 */
class PackageRepository extends EntityRepository
{
    public function getOnpremisePackages()
    {
        $category = 48;
        $result = $this->createQueryBuilder('p')
            ->Join('AppBundle\Entity\Category','cat')
            ->andWhere('cat.status = 1')
            ->andWhere('cat.id =:category')
            ->andWhere('p.category = cat.id')
            ->setParameter('category',$category)
            ->getQuery()
            ->execute();

        return $result;
    }
}
