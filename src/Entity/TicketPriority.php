<?php

namespace App\Entity;

use App\Repository\TicketPriorityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TicketPriorityRepository::class)]
class TicketPriority
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Ticket>
     */
    #[ORM\OneToMany(targetEntity: Ticket::class, mappedBy: 'priority')]
    private Collection $ticketsWithPriority;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    public function __construct()
    {
        $this->ticketsWithPriority = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Ticket>
     */
    public function getTicketsWithPriority(): Collection
    {
        return $this->ticketsWithPriority;
    }

    public function addTicketsWithPriority(Ticket $ticketsWithPriority): static
    {
        if (!$this->ticketsWithPriority->contains($ticketsWithPriority)) {
            $this->ticketsWithPriority->add($ticketsWithPriority);
            $ticketsWithPriority->setPriority($this);
        }

        return $this;
    }

    public function removeTicketsWithPriority(Ticket $ticketsWithPriority): static
    {
        if ($this->ticketsWithPriority->removeElement($ticketsWithPriority)) {
            // set the owning side to null (unless already changed)
            if ($ticketsWithPriority->getPriority() === $this) {
                $ticketsWithPriority->setPriority(null);
            }
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }
}
