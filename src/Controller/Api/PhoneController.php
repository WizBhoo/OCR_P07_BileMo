<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Controller\Api;

use App\Entity\Phone;
use App\Manager\PhoneManager;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class PhoneController.
 *
 * @SWG\Tag(name="Phones")
 */
class PhoneController extends AbstractFOSRestController
{
    /**
     * Retrieves a collection of Phone resource.
     *
     * @param Request         $request
     * @param PhoneManager    $phoneManager
     * @param RouterInterface $router
     *
     * @return Phone[]|null
     *
     * @throws Exception
     *
     * @Rest\Get(
     *     path = "/phones",
     *     name = "api_phones_list",
     * )
     * @Rest\View
     * @Cache(expires="+1 hour", public=true)
     *
     * @SWG\Response(
     *     response = 200,
     *     description = "Get the Phones list with success",
     * )
     * @SWG\Response(
     *     response = 401,
     *     description = "You need a valid token to access this request"
     * )
     */
    public function getPhones(Request $request, PhoneManager $phoneManager, RouterInterface $router): ?array
    {
        $page = $request->query->get('page');

        return [
            "items" => $phoneManager->findAllPhone($page),
            "_links" => [
                "self" => [
                    "href" => $router->generate(
                        "api_phones_list",
                        [],
                        RouterInterface::ABSOLUTE_URL
                    )
                ]
            ],
            "meta" => [
                "limit" => "5",
                "next_page" => $router->generate(
                    "api_phones_list",
                    ['page' => $page === null ? $page+2 : $page+1],
                    RouterInterface::ABSOLUTE_URL
                )
            ],
        ];
    }

    /**
     * Retrieves a Phone resource.
     *
     * @param Phone $phone
     *
     * @return Phone
     *
     * @Rest\Get(
     *     path = "/phones/{id}",
     *     name = "api_phone_details",
     *     requirements = {"id"="\d+"}
     * )
     * @Rest\View
     * @Cache(expires="+1 hour", public=true)
     *
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="integer",
     *     description="A unique phone identifier",
     *     required=true
     * )
     * @SWG\Response(
     *     response = 200,
     *     description = "Get a Phone details with success"
     * )
     * @SWG\Response(
     *     response = 401,
     *     description = "You need a valid token to access this request"
     * )
     * @SWG\Response(
     *     response = 404,
     *     description = "The Phone does not exist"
     * )
     */
    public function getPhone(Phone $phone): Phone
    {
        return $phone;
    }
}
