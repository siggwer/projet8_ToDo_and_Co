<?php

/**
 *
 * @category
 * @package
 * @author   Yohann Zaoui <yohannzaoui@gmail.com>
 * @license
 * @link
 * Created by PhpStorm.
 * Date: 01/02/2019
 * Time: 23:14
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table("user")
 * @ORM\Entity
 * @UniqueEntity("email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     * @Assert\NotBlank(message="Vous devez saisir un nom d'utilisateur.")
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64, nullable=false)
     * @Assert\Length(
     *     min="6",
     *     max="64",
     *     minMessage="Votre mot de passe doit contenir 8 caracteres minimum",
     *     maxMessage="Votre mot de passe doit contenir 64 caracteres maximum"
     * )
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     * @Assert\NotBlank(message="Vous devez saisir une adresse email.")
     * @Assert\Email(message="Le format de l'adresse n'est pas correcte.")
     */
    private $email;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\User", mappedBy="user", orphanRemoval=false)
     */
    private $task;

    /**
     * @ORM\Column(type="array")
     */
    private $roles = [];

    /**
     * User constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ? string
    {
        return $this->username;
    }

    /**
     * @param $username
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    /**
     * @return string|null
     */
    public function getSalt(): ? string
    {
        return null;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ? string
    {
        return $this->password;
    }

    /**
     * @param $password
     */
    public function setPassword(? string $password)
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ? string
    {
        return $this->email;
    }

    /**
     * @param $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @param $roles
     */
    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }

    /**
     *
     */
    public function eraseCredentials()
    {
        return null;
    }

    /**
     * @return Task
     */
    public function getTask(): Task
    {
        return $this->task;
    }

    /**
     * @param mixed $task
     */
    public function setTask(Task $task)
    {
        $this->task = $task;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

}
