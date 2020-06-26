<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Manager;

use App\Entity\Client;
use App\Entity\ClientUser;
use App\Repository\ClientUserRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Exception;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ClientUserManager.
 */
class ClientUserManager
{
    /**
     * A ClientUserRepository Instance.
     *
     * @var ClientUserRepository
     */
    private $clientUserRepository;

    /**
     * ClientUserManager constructor.
     *
     * @param ClientUserRepository $clientUserRepository
     */
    public function __construct(ClientUserRepository $clientUserRepository)
    {
        $this->clientUserRepository = $clientUserRepository;
    }

    /**
     * Retrieves all ClientUsers who belong to Client from db and paginates the list.
     *
     * @param int|null $page
     * @param Client   $client
     *
     * @return array
     *
     * @throws Exception
     */
    public function clientUsersList(?int $page, Client $client)
    {
        if (null === $page || $page < 1) {
            $page = 1;
        }

        $limit = 5;

        $data = $this->clientUserRepository->findClientUsers($page, $limit, $client);

        return $data->getIterator()->getArrayCopy();
    }

    /**
     * Create a new User in DB who belongs to a Client.
     *
     * @param Client     $client
     * @param ClientUser $clientUser
     *
     * @return void
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function createClientUser(Client $client, ClientUser $clientUser): void
    {
        $client->addClientUser($clientUser);
        $this->clientUserRepository->create($clientUser);
    }

    /**
     * Delete a User in DB who belongs to a Client.
     *
     * @param ClientUser $clientUser
     *
     * @return void
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function deleteClientUser(ClientUser $clientUser): void
    {
        $this->clientUserRepository->delete($clientUser);
    }
}
