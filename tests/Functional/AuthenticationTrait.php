<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;

/**
 * Trait AuthenticationTrait.
 */
trait AuthenticationTrait
{
    /**
     * Helper to access test Client
     *
     * @var KernelBrowser
     */
    private $client;

    /**
     * Make a tested request with Client authentication by JWT
     *
     * @param string     $login
     * @param string     $verb
     * @param string     $url
     * @param array|null $data
     *
     * @return void
     */
    public function requestAuthenticated(string $login, string $verb, string $url, ?array $data = null): void
    {
        $arrayLogin = array('username' => $login);
        $token = $this->client->getContainer()
            ->get('lexik_jwt_authentication.encoder')
            ->encode($arrayLogin);

        $this->client->request(
            $verb,
            $url,
            [],
            [],
            [
                'HTTP_AUTHORIZATION' => 'Bearer '. $token,
                'CONTENT_TYPE' => 'application/json',
            ],
            $data ? json_encode($data) : null
        );
    }
}
