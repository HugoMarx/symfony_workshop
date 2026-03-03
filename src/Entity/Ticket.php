<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TicketRepository::class)]
class Ticket
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTime $created = null;

    #[ORM\Column]
    private ?\DateTime $modified = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $completed = null;

    #[ORM\ManyToOne(inversedBy: 'authoredTickets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $author = null;

    #[ORM\ManyToOne(inversedBy: 'ticketsWithStatus')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TicketStatus $status = null;

    #[ORM\ManyToOne(inversedBy: 'ticketsWithPriority')]
    private ?TicketPriority $priority = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'assignedTickets')]
    private Collection $assignee;

    public function __construct()
    {
        $this->assignee = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCreated(): ?\DateTime
    {
        return $this->created;
    }

    public function setCreated(\DateTime $created): static
    {
        $this->created = $created;

        return $this;
    }

    public function getModified(): ?\DateTime
    {
        return $this->modified;
    }

    public function setModified(\DateTime $modified): static
    {
        $this->modified = $modified;

        return $this;
    }

    public function getCompleted(): ?\DateTime
    {
        return $this->completed;
    }

    public function setCompleted(?\DateTime $completed): static
    {
        $this->completed = $completed;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getStatus(): ?TicketStatus
    {
        return $this->status;
    }

    public function setStatus(?TicketStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getPriority(): ?TicketPriority
    {
        return $this->priority;
    }

    public function setPriority(?TicketPriority $priority): static
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getAssignee(): Collection
    {
        return $this->assignee;
    }

    public function addAssignee(User $assignee): static
    {
        if (!$this->assignee->contains($assignee)) {
            $this->assignee->add($assignee);
        }

        return $this;
    }

    public function removeAssignee(User $assignee): static
    {
        $this->assignee->removeElement($assignee);

        return $this;
    }
}
