<?php

namespace App\Entity;

use App\Repository\LeagueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LeagueRepository::class)]
class League
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'datetime_immutable')]
    private $created_at;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private $updated_at;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $disabled;

    #[ORM\OneToMany(mappedBy: 'league', targetEntity: Championship::class)]
    private $championships;

    public function __construct()
    {
        $this->championships = new ArrayCollection();
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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * Gets triggered only on insert
     */
    #[ORM\PrePersist]
    public function onPrePersist()
    {
        $this->created_at = new \DateTime("now");
    }

    /**
     * Gets triggered every time on update
     */
    #[ORM\PreUpdate]
    public function onPreUpdate()
    {
        $this->updated_at = new \DateTime("now");
    }

    /**
     * @return Collection<int, Championship>
     */
    public function getChampionships(): Collection
    {
        return $this->championships;
    }

    public function isDisabled(): ?bool
    {
        return $this->disabled;
    }

    public function setDisabled(?bool $disabled): self
    {
        $this->disabled = $disabled;

        return $this;
    }

    public function addChampionship(Championship $championship): self
    {
        if (!$this->championships->contains($championship)) {
            $this->championships[] = $championship;
            $championship->setLeague($this);
        }

        return $this;
    }

    public function removeChampionship(Championship $championship): self
    {
        if ($this->championships->removeElement($championship)) {
            // set the owning side to null (unless already changed)
            if ($championship->getLeague() === $this) {
                $championship->setLeague(null);
            }
        }

        return $this;
    }
}
