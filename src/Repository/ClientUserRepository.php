<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Repository;

use App\Entity\Client;
use App\Entity\ClientUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class ClientUserRepository.
 *
 * @method ClientUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClientUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClientUser[]    findAll()
 * @method ClientUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientUserRepository extends ServiceEntityRepository
{
    /**
     * ClientUserRepository constructor.
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClientUser::class);
    }

    /**
     * Retrieves Users list who belong to a Client in DB and paginated.
     *
     * @param int    $page
     * @param int    $limit
     * @param Client $client
     *
     * @return Paginator
     */
    public function findClientUsers(int $page, int $limit, Client $client): Paginator
    {
        $query = $this->createQueryBuilder('c')
            ->where('c.client = '.$client->getId())
            ->getQuery()
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit);

        return new Paginator($query);
    }

    /**
     * Persists new User in db.
     *
     * @param ClientUser $clientUser
     *
     * @return void
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(ClientUser $clientUser): void
    {
        $this->_em->persist($clientUser);
        $this->_em->flush();
    }

    /**
     * Remove a User in db.
     *
     * @param ClientUser $clientUser
     *
     * @return void
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(ClientUser $clientUser): void
    {
        $this->_em->remove($clientUser);
        $this->_em->flush();
    }
}
