<?php

declare(strict_types = 1);

namespace App\Repository;

use App\Entity\Pizzeria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class PizzeriaRepository
 * @package App\Repository
 */
class PizzeriaRepository extends ServiceEntityRepository
{
    /**
     * PizzeriaRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pizzeria::class);
    }

    /**
     * @param int $pizzeriaId
     * @return Pizzeria
     */
    public function findCartePizzeria($pizzeriaId): Pizzeria
    {
        if (!is_numeric($pizzeriaId) || $pizzeriaId <= 0) {
            throw new \Exception("Impossible de d'obtenir la carte de la pizzeria ({$pizzeriaId}).");
        }

        // création du query builder avec l'alias pr pour pizzeria
        $qb = $this->createQueryBuilder("pr");

        // création de la requête
        $qb
            ->addSelect(["nom", "mrg", "pzs", "cou"])
            ->innerJoin("pr.nom", "nom")
            ->innerJoin("pr.marge", "mrg")
            ->innerJoin("pr.pizzas", "pzs")
            ->innerJoin("pr.pizza.cout", "cou")
            ->where("pr.id = :idPizzeria")
            ->setParameter("idPizzeria", $pizzeriaId)
        ;

        // exécution de la requête
        return $qb->getQuery()->getSingleResult();

    }
}
