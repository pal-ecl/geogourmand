<?php
/**
 * Created by PhpStorm.
 * User: Wizpaul
 * Date: 23/04/2019
 * Time: 15:39
 */

namespace App\Repository;

use Doctrine\ORM\EntityRepository;


class SpecialtyRepository extends EntityRepository
{
    public function findSpecialties()
    {
        $qb = $this->createQueryBuilder('s');

        return $qb
            ->select('s', 't')
            ->leftJoin('s.tags', 't')
            ->getQuery()
            ->getResult();
    }


    public function findPostsByTag($label)
    {
        $qb = $this->createQueryBuilder('s');

        return $qb
            ->select('s','t')
            ->leftJoin('s.tags', 't')
            ->where('t.label =:label')
            ->setParameter("label",$label)
            ->getQuery()
            ->getResult();
    }

    public function findTags($label)
    {
        $qb = $this->createQueryBuilder('s');

        return $qb
            ->select('t')
            ->leftjoin('s.tags', 't')
            ->getQuery()
            ->getResult();
    }

    public function findSpecialtiesToDisplay()
    {
        $qb = $this->createQueryBuilder('s');

        return $qb
            ->select('s')
            ->getQuery()
            ->getResult();
    }
}