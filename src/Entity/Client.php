<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $codeClient;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $formeJuridique;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomSociete;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $siret;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\ManyToMany(targetEntity=Collaborateur::class, mappedBy="clients")
     */
    private $collabos;





    public function __construct()
    {
        $this->collaborateurs = new ArrayCollection();
        $this->collabos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeClient(): ?string
    {
        return $this->codeClient;
    }

    public function setCodeClient(string $codeClient): self
    {
        $this->codeClient = $codeClient;

        return $this;
    }

    public function getFormeJuridique(): ?string
    {
        return $this->formeJuridique;
    }

    public function setFormeJuridique(string $formeJuridique): self
    {
        $this->formeJuridique = $formeJuridique;

        return $this;
    }

    public function getNomSociete(): ?string
    {
        return $this->nomSociete;
    }

    public function setNomSociete(string $nomSociete): self
    {
        $this->nomSociete = $nomSociete;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(?string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection|Collaborateur[]
     */
    public function getCollabos(): Collection
    {
        return $this->collabos;
    }

    public function addCollabo(Collaborateur $collabo): self
    {
        if (!$this->collabos->contains($collabo)) {
            $this->collabos[] = $collabo;
            $collabo->addClient($this);
        }

        return $this;
    }

    public function removeCollabo(Collaborateur $collabo): self
    {
        if ($this->collabos->removeElement($collabo)) {
            $collabo->removeClient($this);
        }

        return $this;
    }



  
}
