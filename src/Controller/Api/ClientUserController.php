<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Controller\Api;

use App\Entity\Client;
use App\Entity\ClientUser;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityNotFoundException;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swagger\Annotations as SWG;

/**
 * Class ClientUserController.
 *
 * @SWG\Tag(name="Client Users")
 */
class ClientUserController extends AbstractFOSRestController
{
    /**
     * Retrieves a collection of User resource who belong to a Client
     *
     * @param Client $client
     *
     * @return Collection|null
     *
     * @Rest\Get(
     *     path = "/clients/{id}/users",
     *     name = "api_client_users_list",
     *     requirements = {"id"="\d+"}
     * )
     * @Rest\View(
     *     serializerGroups={"client", "user"}
     * )
     *
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="integer",
     *     description="A unique client identifier",
     *     required=true
     * )
     * @SWG\Response(
     *     response = 200,
     *     description = "Get a Client Users list with success"
     * )
     * @SWG\Response(
     *     response = 404,
     *     description = "The Client does not exist"
     * )
     */
    public function getClientUsers(Client $client): ?Collection
    {
        return $client->getClientUsers();
    }

    /**
     * Retrieves details of a User resource who belongs to a Client
     *
     * @param Client     $client
     * @param ClientUser $clientUser
     *
     * @return ClientUser|null
     *
     * @throws EntityNotFoundException
     *
     * @Rest\Get(
     *     path = "/clients/{clientId}/users/{userId}",
     *     name = "api_client_user_details",
     *     requirements = {"clientId"="\d+", "userId"="\d+"}
     * )
     * @Rest\View(
     *     serializerGroups={"client", "user", "user_details"}
     * )
     * @ParamConverter(
     *     "client", options={"id" = "clientId"}
     * )
     * @ParamConverter(
     *     "clientUser", options={"id" = "userId"}
     * )
     *
     * @SWG\Parameter(
     *     name="clientId",
     *     in="path",
     *     type="integer",
     *     description="A unique client identifier",
     *     required=true
     * )
     * @SWG\Parameter(
     *     name="userId",
     *     in="path",
     *     type="integer",
     *     description="A unique user identifier",
     *     required=true
     * )
     * @SWG\Response(
     *     response = 200,
     *     description = "Get a Client Users list with success"
     * )
     * @SWG\Response(
     *     response = 404,
     *     description = "Wrong User and/or Client"
     * )
     */
    public function getClientUserDetails(Client $client, ClientUser $clientUser): ?ClientUser
    {
        if ($clientUser->getClient() !== $client) {
            throw new EntityNotFoundException(
                "Wrong User and/or Client"
            );
        }

        return $clientUser;
    }
}
