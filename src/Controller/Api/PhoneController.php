<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Controller\Api;

use App\Entity\Phone;
use App\Manager\PhoneManager;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Swagger\Annotations as SWG;

/**
 * Class PhoneController.
 *
 * @SWG\Tag(name="Phones")
 */
class PhoneController extends AbstractFOSRestController
{
    /**
     * Retrieves a collection of Phone resource
     *
     * @param PhoneManager $phoneManager
     *
     * @return Phone[]|null
     *
     * @Rest\Get(
     *     path = "/phones",
     *     name = "api_phones_list",
     * )
     * @Rest\View
     * @Cache(expires="+3 hour", public=true)
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
    public function getPhones(PhoneManager $phoneManager): ?array
    {
        return $phoneManager->findAllPhone();
    }

    /**
     * Retrieves a Phone resource
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
     * @Cache(expires="+3 hour", public=true)
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
