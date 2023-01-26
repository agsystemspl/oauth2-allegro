<?php

namespace AGSystems\OAuth2\Client\Provider;

use League\OAuth2\Client\OptionProvider\HttpBasicAuthOptionProvider;
use League\OAuth2\Client\OptionProvider\OptionProviderInterface;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;

class Allegro extends AbstractProvider
{
    use BearerAuthorizationTrait;

    const ACCESS_TOKEN_RESOURCE_OWNER_ID = 'user_name';

    public function getBaseAuthorizationUrl()
    {
        return 'https://allegro.pl/auth/oauth/authorize';
    }

    public function getBaseAccessTokenUrl(array $params)
    {
        return 'https://allegro.pl/auth/oauth/token';
    }

    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        return 'https://api.allegro.pl/me';
    }

    protected function getDefaultScopes()
    {
        return [
            'allegro:api:profile:read',
            'allegro:api:profile:write',
            'allegro:api:sale:offers:read',
            'allegro:api:sale:offers:write',
            'allegro:api:orders:read',
            'allegro:api:orders:write',
            'allegro:api:ratings',
            'allegro:api:disputes',
            'allegro:api:bids',
            'allegro:api:messaging',
            'allegro:api:billing:read',
            'allegro:api:payments:read',
            'allegro:api:payments:write',
            'allegro:api:sale:settings:read',
            'allegro:api:sale:settings:write',
            'allegro:api:campaigns',
            'allegro:api:fulfillment:read',
            'allegro:api:fulfillment:write'
        ];
    }

    protected function getScopeSeparator()
    {
        return ' ';
    }

    protected function checkResponse(ResponseInterface $response, $data)
    {
        if (!empty($data['error'])) {
            throw new IdentityProviderException($data['error_description'], $response->getStatusCode(), $data);
        }
    }

    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return new AllegroResourceOwner($response);
    }

    public function setOptionProvider(OptionProviderInterface $provider)
    {
        $provider = new HttpBasicAuthOptionProvider();
        return parent::setOptionProvider($provider);
    }
}
