<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Controller\Api;

use App\Entity\Client;
use App\Entity\ClientUser;
use App\Exception\ResourceValidationException;
use App\Manager\ClientUserManager;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\ConstraintViolationList;

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
     *     serializerGroups={"client", "user_list"}
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
     *     serializerGroups={"client", "user_details"}
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

    /**
     * Add a User resource belonging to the Client who adds him
     *
     * @param Client                  $client
     * @param ClientUser              $clientUser
     * @param ClientUserManager       $clientUserManager
     * @param ConstraintViolationList $violations
     *
     * @return View
     *
     * @throws ResourceValidationException
     * @throws ORMException
     * @throws OptimisticLockException
     *
     * @Rest\Post(
     *     path = "/clients/{id}/users",
     *     name = "api_client_user_create",
     *     requirements = {"id"="\d+"}
     * )
     * @Rest\View(
     *     statusCode = 201,
     *     serializerGroups={"client", "user_details"}
     * )
     * @ParamConverter(
     *     "clientUser", converter="fos_rest.request_body"
     * )
     *
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="integer",
     *     description="A unique client identifier",
     *     required=true
     * )
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     description="List of User properties",
     *     required=true,
     *     @SWG\Schema(
     *         type="object",
     *         @SWG\Property(property="name", type="string"),
     *         @SWG\Property(property="username", type="string"),
     *         @SWG\Property(property="email", type="string")
     *     )
     * )
     * @SWG\Response(
     *     response = 201,
     *     description = "User successfully added to the Client",
     *     @Model(type=ClientUser::class, groups={"user_details"})
     * )
     * @SWG\Response(
     *     response = 400,
     *     description = "Bad data sent, check fields and try again"
     * )
     */
    public function createClientUser(Client $client, ClientUser $clientUser, ClientUserManager $clientUserManager, ConstraintViolationList $violations): View
    {
        if (count($violations)) {
            $message = "Wrong data sent, please correct following fields : ";
            foreach ($violations as $violation) {
                $message .= sprintf("Filed %s : %s ", $violation->getPropertyPath(), $violation->getMessage());
            }

            throw new ResourceValidationException($message);
        }
        $clientUserManager->createClientUser($client, $clientUser);

        return $this->view(
            $clientUser,
            Response::HTTP_CREATED,
            [
                'Location' => $this->generateUrl(
                    'api_client_user_details',
                    [
                        'clientId' => $client->getId(),
                        'userId' => $clientUser->getId()
                    ],
                    UrlGeneratorInterface::ABSOLUTE_URL)
            ]
        );
    }
}
