<?php

namespace App\Model;

use App\Entity\Strategy;
use Symfony\Component\Validator\Constraints as Assert;

class Shortener 
{
    /**
     * @Assert\NotBlank
     * @var string
     */
    private $url;

    /**
     * @Assert\NotBlank
     * @var Strategy
     */
    private $strategy;

    /**
     * @Assert\NotBlank
     * @var string
     */
    private $hash;

    public function getUrl() :string
    {
        return $this->url;
    }

    public function setUrl(string $url) :void
    {
        $this->url = $url;
    }

    public function getStrategy() :?Strategy
    {
        return $this->strategy;
    }

    public function setStrategy(Strategy $strategy) :void
    {
        $this->strategy = $strategy;
    }

    public function getHash() :string
    {
        return $this->hash;
    }

    public function setHash(string $hash) :void
    {
        $this->hash = $hash;
    }

    public function getHashWithoutDomain()
    {
        
    }
}