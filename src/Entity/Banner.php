<?php

namespace App\Entity;

use App\Repository\BannerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BannerRepository::class)]
class Banner
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $bannername = null;

    #[ORM\Column(length: 500)]
    private ?string $bannerinfo = null;

    #[ORM\Column(length: 500)]
    private ?string $imagepath = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\ManyToOne(inversedBy: 'banners')]
    private ?Product $product = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBannername(): ?string
    {
        return $this->bannername;
    }

    public function setBannername(string $bannername): self
    {
        $this->bannername = $bannername;

        return $this;
    }

    public function getBannerinfo(): ?string
    {
        return $this->bannerinfo;
    }

    public function setBannerinfo(string $bannerinfo): self
    {
        $this->bannerinfo = $bannerinfo;

        return $this;
    }

    public function getImagepath(): ?string
    {
        return $this->imagepath;
    }

    public function setImagepath(string $imagepath): self
    {
        $this->imagepath = $imagepath;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }
}
