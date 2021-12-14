<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UtilisateurRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 * @UniqueEntity(
 * fields={"mail"},
 * message="Ce mail est déjà utilisé"
 * )
 */
class Utilisateur implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5, minMessage="Le mot de passe doit être supérieur à 5 caractères")
     * @Assert\EqualTo(propertyPath="confirm_mdp", message="Vos mots de passe ne sont pas identique")
     */
    private $mdp;

    /**
     * @Assert\Length(min=5, minMessage="Le mot de passe doit être supérieur à 5 caractères")
     * @Assert\EqualTo(propertyPath="mdp", message="Vos mots de passe ne sont pas identique")
     */
    public $confirm_mdp;
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }
    public function eraseCredentials()
    {
        
    }
    public function getSalt()
    {
        
    }
    public function getRoles()
    {
        return ['ROLE_USER'];
    }
    public function getUserIdentifier()
    {
        return $this->mail;
    }
    public function getPassword()
    {
        return $this->mdp;
    }
    public function getUsername()
    {
        return $this->mail;
    }
}
