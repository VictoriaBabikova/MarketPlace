<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $productname = null;

    #[ORM\Column]
    private ?float $pricein = null;

    #[ORM\Column]
    private ?float $pricesale = null;

    #[ORM\Column(length: 2000)]
    private ?string $info = null;

    #[ORM\Column(length: 1500, nullable: true)]
    private ?string $specifications = null;

    #[ORM\Column(length: 500)]
    private ?string $imagepath = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: Banner::class)]
    private Collection $banners;

    #[ORM\ManyToMany(targetEntity: Seller::class, mappedBy: 'product')]
    private Collection $sellers;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: Feedback::class)]
    private Collection $feedback;

    public function __construct()
    {
        $this->banners = new ArrayCollection();
        $this->sellers = new ArrayCollection();
        $this->feedback = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductname(): ?string
    {
        return $this->productname;
    }

    public function setProductname(string $productname): self
    {
        $this->productname = $productname;

        return $this;
    }

    public function getPricein(): ?float
    {
        return $this->pricein;
    }

    public function setPricein(float $pricein): self
    {
        $this->pricein = $pricein;

        return $this;
    }

    public function getPricesale(): ?float
    {
        return $this->pricesale;
    }

    public function setPricesale(float $pricesale): self
    {
        $this->pricesale = $pricesale;

        return $this;
    }

    public function getInfo(): ?string
    {
        return $this->info;
    }

    public function setInfo(string $info): self
    {
        $this->info = $info;

        return $this;
    }

    public function getSpecifications(): ?string
    {
        return $this->specifications;
    }

    public function setSpecifications(?string $specifications): self
    {
        $this->specifications = $specifications;

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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Banner>
     */
    public function getBanners(): Collection
    {
        return $this->banners;
    }

    public function addBanner(Banner $banner): self
    {
        if (!$this->banners->contains($banner)) {
            $this->banners->add($banner);
            $banner->setProduct($this);
        }

        return $this;
    }

    public function removeBanner(Banner $banner): self
    {
        if ($this->banners->removeElement($banner)) {
            // set the owning side to null (unless already changed)
            if ($banner->getProduct() === $this) {
                $banner->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Seller>
     */
    public function getSellers(): Collection
    {
        return $this->sellers;
    }

    public function addSeller(Seller $seller): self
    {
        if (!$this->sellers->contains($seller)) {
            $this->sellers->add($seller);
            $seller->addProduct($this);
        }

        return $this;
    }

    public function removeSeller(Seller $seller): self
    {
        if ($this->sellers->removeElement($seller)) {
            $seller->removeProduct($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Feedback>
     */
    public function getFeedback(): Collection
    {
        return $this->feedback;
    }

    public function addFeedback(Feedback $feedback): self
    {
        if (!$this->feedback->contains($feedback)) {
            $this->feedback->add($feedback);
            $feedback->setProduct($this);
        }

        return $this;
    }

    public function removeFeedback(Feedback $feedback): self
    {
        if ($this->feedback->removeElement($feedback)) {
            // set the owning side to null (unless already changed)
            if ($feedback->getProduct() === $this) {
                $feedback->setProduct(null);
            }
        }

        return $this;
    }
}
