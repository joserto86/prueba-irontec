<?php

namespace App\Entity;

use App\Repository\StrategyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StrategyRepository::class)
 */
class Strategy
{
    public const ALPHANUMERIC = 1;
    public const LETTERS = 2;
    public const NUMERIC = 3;
    public const CUSTOM = 4;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=ShortenedUrl::class, mappedBy="strategy")
     */
    private $shortenedUrls;

    /**
     * @var string
     */
    private $color;

    /**
     * @var string
     */
    private $hoverColor;

    /**
     * @var string
     */
    private $colorClass;

    /**
     * @var int
     */
    private $percentUse;

    public function __construct()
    {
        $this->shortenedUrls = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|ShortenedUrl[]
     */
    public function getShortenedUrls(): Collection
    {
        return $this->shortenedUrls;
    }

    public function getColor() :string
    {
        return $this->color;
    }

    public function getHoverColor() :string
    {
        return $this->hoverColor;
    }

    public function getColorClass() :string
    {
        return $this->colorClass;
    }

    public function setPercentUse(int $percentUse) :self
    {
        $this->percentUse = $percentUse;
        return $this;
    }

    public function getPercentUse() :string
    {
        return $this->percentUse;
    }

    public function setViewParams()
    {
        switch ($this->id)
        {
            case Strategy::ALPHANUMERIC:
               $this->color = '#4e73df';
               $this->hoverColor = '#2e59d9';
               $this->colorClass = 'text-primary';
               break;
            case Strategy::LETTERS:
                $this->color = '#1cc88a';
                $this->hoverColor = '#17a673';
                $this->colorClass = 'text-success';
                break;
            case Strategy::NUMERIC:
                $this->color = '#36b9cc';
                $this->hoverColor = '#2c9faf';
                $this->colorClass = 'text-info';
                break;
            case Strategy::CUSTOM:
                break;
        }
        return $this;
    }

    public function addShortenedUrl(ShortenedUrl $shortenedUrl): self
    {
        if (!$this->shortenedUrls->contains($shortenedUrl)) {
            $this->shortenedUrls[] = $shortenedUrl;
            $shortenedUrl->setStrategy($this);
        }

        return $this;
    }

    public function removeShortenedUrl(ShortenedUrl $shortenedUrl): self
    {
        if ($this->shortenedUrls->removeElement($shortenedUrl)) {
            // set the owning side to null (unless already changed)
            if ($shortenedUrl->getStrategy() === $this) {
                $shortenedUrl->setStrategy(null);
            }
        }

        return $this;
    }
}
