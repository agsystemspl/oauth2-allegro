<?php

namespace AGSystems\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Tool\ArrayAccessorTrait;

class AllegroResourceOwner implements ResourceOwnerInterface
{
    use ArrayAccessorTrait;

    protected $me;

    public function __construct(array $response)
    {
        $this->me = $response;
    }

    public function getId()
    {
        return $this->getValueByKey($this->me, 'id');
    }

    public function getLogin()
    {
        return $this->getValueByKey($this->me, 'login');
    }

    public function toArray()
    {
        return $this->me;
    }
}
