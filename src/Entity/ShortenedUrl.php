<?php

namespace App\Entity;

use App\Repository\ShortenedUrlRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShortenedUrlRepository::class)
 */
class ShortenedUrl
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $hash;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $longUrl;

    /**
     * @ORM\Column(type="integer")
     */
    private $visits;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastVisit;

    /**
     * @ORM\ManyToOne(targetEntity=Strategy::class, inversedBy="shortenedUrls")
     * @ORM\JoinColumn(nullable=false)
     */
    private $strategy;

    /**
     * @var int
     */
    private $percentUse;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function setHash(string $hash): self
    {
        $this->hash = $hash;

        return $this;
    }

    public function getLongUrl(): ?string
    {
        return $this->longUrl;
    }

    public function setLongUrl(string $longUrl): self
    {
        $this->longUrl = $longUrl;

        return $this;
    }

    public function getVisits(): ?int
    {
        return $this->visits;
    }

    public function setVisits(int $visits): self
    {
        $this->visits = $visits;

        return $this;
    }

    public function getLastVisit(): ?\DateTimeInterface
    {
        return $this->lastVisit;
    }

    public function setLastVisit(?\DateTimeInterface $lastVisit): self
    {
        $this->lastVisit = $lastVisit;

        return $this;
    }

    public function getStrategy(): ?Strategy
    {
        return $this->strategy;
    }

    public function setStrategy(?Strategy $strategy): self
    {
        $this->strategy = $strategy;

        return $this;
    }

    public function setPercentUse(int $percentUse) :self
    {
        $this->percentUse = $percentUse;
        return $this;
    }

    public function getPercentUse(): int
    {
        return $this->percentUse;
    }

    public function addVisit(int $visits = 1) :self
    {
        $this->visits += $visits;
        return $this;
    }

}
