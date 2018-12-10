<?php

namespace AGSystems\OAuth2\Client\Token;

interface AccessTokenInterface extends \League\OAuth2\Client\Token\AccessTokenInterface
{
    public function saveAuth(AccessTokenInterface $accessToken);
}
