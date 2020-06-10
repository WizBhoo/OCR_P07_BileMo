<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Controller\Api;

use App\Entity\Phone;
use App\Manager\PhoneManager;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
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
     * @Rest\Get(
     *     path = "/phones",
     *     name = "api_phones_list",
     * )
     * @Rest\View
     *
     * @SWG\Response(
     *     response = 200,
     *     description = "Get the Phones list with success"
     * )
     *
     * @return Phone[]|null
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
     * @Rest\Get(
     *     path = "/phones/{id}",
     *     name = "api_phone_details",
     *     requirements = {"id"="\d+"}
     * )
     * @Rest\View
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
     *     response = 404,
     *     description = "The Phone does not exist"
     * )
     *
     * @return Phone
     */
    public function getPhone(Phone $phone): Phone
    {
        return $phone;
    }
}
