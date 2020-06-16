<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Serializer;

use App\Entity\ClientUser;
use ArrayObject;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * Class ClientUserNormalizer.
 */
class ClientUserNormalizer implements ContextAwareNormalizerInterface
{
    /**
     * An UrlGeneratorInterface Injection.
     *
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     * An ObjectNormalizer Instance.
     *
     * @var ObjectNormalizer
     */
    private $normalizer;

    /**
     * ClientUserNormalizer constructor.
     *
     * @param UrlGeneratorInterface $router
     * @param ObjectNormalizer      $normalizer
     */
    public function __construct(UrlGeneratorInterface $router, ObjectNormalizer $normalizer)
    {
        $this->router = $router;
        $this->normalizer = $normalizer;
    }

    /**
     * Normalizes ClientUser object.
     *
     * @param mixed $clientUser
     * @param null  $format
     * @param array $context
     *
     * @return array|ArrayObject|bool|float|int|mixed|string|null
     *
     * @throws ExceptionInterface
     */
    public function normalize($clientUser, $format = null, array $context = [])
    {
        $data = $this->normalizer->normalize($clientUser, $format, $context);

        $data['_links']['self']['href'] = $this->router->generate(
            'api_client_user_details',
            [
                'clientId' => $clientUser->getClient()->getId(),
                'userId' => $clientUser->getId()
            ],
            UrlGeneratorInterface::ABSOLUTE_URL
        );
        $data['_links']['delete']['href'] = $this->router->generate(
            'api_client_user_delete',
            [
                'clientId' => $clientUser->getClient()->getId(),
                'userId' => $clientUser->getId()
            ],
            UrlGeneratorInterface::ABSOLUTE_URL
        );
        $data['_embedded']["client"] = $this->normalizer->normalize(
            $clientUser->getClient(),
            $format,
            $context
        );

        return $data;
    }

    /**
     * Checks whether the given class is supported for normalization by this normalizer.
     *
     * @param mixed $data
     * @param null  $format
     * @param array $context
     *
     * @return bool
     */
    public function supportsNormalization($data, $format = null, array $context = []): bool
    {
        return $data instanceof ClientUser;
    }
}
