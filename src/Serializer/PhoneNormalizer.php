<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Serializer;

use App\Entity\Phone;
use ArrayObject;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * Class PhoneNormalizer.
 */
class PhoneNormalizer implements ContextAwareNormalizerInterface
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
     * PhoneNormalizer constructor.
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
     * Normalizes Phone object.
     *
     * @param mixed $phone
     * @param null  $format
     * @param array $context
     *
     * @return array|ArrayObject|bool|float|int|mixed|string|null
     *
     * @throws ExceptionInterface
     */
    public function normalize($phone, $format = null, array $context = [])
    {
        $data = $this->normalizer->normalize($phone, $format, $context);

        $data['_links']['self']['href'] = $this->router->generate(
            'api_phone_details',
            ['id' => $phone->getId()],
            UrlGeneratorInterface::ABSOLUTE_URL
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
        return $data instanceof Phone;
    }
}
