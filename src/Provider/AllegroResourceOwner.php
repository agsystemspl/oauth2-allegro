<?php

namespace AGSystems\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\ArrayAccessorTrait;

class AllegroResourceOwner implements ResourceOwnerInterface
{
    use ArrayAccessorTrait;

    protected $claims;

    public function __construct(AccessToken $token)
    {
        list(, $claims,) = explode('.', $token);
        $this->claims = json_decode(base64_decode($claims), true);
    }

    public function getId()
    {
        return $this->getValueByKey($this->claims, Esi::ACCESS_TOKEN_RESOURCE_OWNER_ID);
    }

    public function toArray()
    {
        return $this->claims;
    }
}
