# API BileMo - Getting Started

Realized by Adrien PIERRARD - [(see GitHub)](https://github.com/WizBhoo)

Supported by Antoine De Conto - OCR Mentor

Special thanks to Rui TEIXEIRA and Yann LUCAS for PR Reviews

-------------------------------------------------------------------------------------------------------------------------------------

## Prerequisites

*   Have installed the project by following [README.md](../../README.md) instructions.
*   You need to have the openssl extension on your machine.

## Bundles used

*   By installing the project, the following bundles have been registered - see the `composer.json` file :

    *   Note that the serializer used is the Symfony one.
    *   [`friendsofsymfony/rest-bundle`](https://packagist.org/packages/friendsofsymfony/rest-bundle)
    *   [`nelmio/api-doc-bundle`](https://packagist.org/packages/nelmio/api-doc-bundle)
    *   [`lexik/jwt-authentication-bundle`](https://packagist.org/packages/lexik/jwt-authentication-bundle)

## Lexik JWT Configuration

*   Practically nothing to do except take note of the JWT_PASSPHRASE in the `.env` file.
*   You can define your own JWT_PASSPHRASE if you want.

### Generate the SSH keys :

*   From your terminal, tape those command line :

``` console
$ mkdir -p config/jwt
$ openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
$ openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout
```

*   When asked, enter the JWT_PASSPHRASE defined above.

## Usage

### 1. Obtain a JSON Web Token

*   As only registered Client can send requests to the BileMo API, the first step is to generate a token using Client's credentials.
*   To do this, tape those command lines in your terminal, from the Docker directory :

```console
make sh
cd symfony/
composer install
php bin/console lexik:jwt:generate-token <email as username>
``` 

*   In the last command line, replace "email as username" by a registered Client's e-mail.
*   I let you find where you will be able to know which registered Clients exist.
*   Store the JWT (client side), it is reusable until its ttl has expired (3600 seconds by default, but I defined 1 year ;-).

### 2. Use the JWT

*   Simply pass the JWT on each request to the protected firewall, as an authorization header.
*   By default, only the authorization header mode is enabled : `Authorization: Bearer {JWT}`

<blockquote>
About token expiration (small ttl definition) :

*   Each request after token expiration will result in a 401 response.
*   Redo the authentication process to obtain a new token.
</blockquote>

-------------------------------------------------------------------------------------------------------------------------------------

## What you can do with BileMo API

*   Available requests are documented in the API Doc made with Nelmio.
*   The BileMo API documentation is available from the local home page depending on the way you installed the project.
*   You will send request as a BileMo registered Client, so each request requires an authentication by JWT as explained above.
*   So don't forget to add the following header rule : `Authorization: Bearer {JWT}`.
*   Data sent by the API are served in Json so if you use a software like Postman to request, add the following header rule : `Content-Type: application/json`.

### 1. Phones Resource

*   All registered Clients can retrieved the Phones List.
*   All registered Clients can retrieved details about one phone in particular.

### 2. Users Resource

*   A registered Client can only retrieved the Users List that belong to him.
*   A registered Client can only retrieved details about a User who belongs to him.
*   A registered Client can only add Users who belong to him.

### 3. Success codes in Response

*   200 : OK
*   201 : User successfully added to the Client
*   204 : User successfully deleted

### 4. Error codes in Response

*   400 : Wrong data sent, please correct following fields : ...
*   401 : Invalid JWT Token / JWT Token not found / Expired JWT Token
*   403 : Forbidden access to this content
*   404 : Resource not found

-------------------------------------------------------------------------------------------------------------------------------------

## Contact

Thanks in advance for Star contribution

Any question / trouble ?

Please send me an [e-mail](mailto:apierrard.contact@gmail.com) ;-)
