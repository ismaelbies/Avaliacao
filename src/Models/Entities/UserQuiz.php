<?php


namespace App\Models\Entities;

/**
 * @Entity @Table(name="usersQuiz")
 * @ORM @Entity(repositoryClass="App\Models\Repository\UserQuizRepository")
 */
class UserQuiz
{
    /**
     * @Id @GeneratedValue @Column(type="integer")
     */
    protected ?int $id = null;

    /**
     * @Column(type="string")
     */
    protected string $name = '';

    /**
     * @Column(type="string")
     */
    protected string $email = '';

    /**
     * @Column(type="string")
     */
    protected string $password = '';

    /**
     * UserQuiz constructor.
     * @param int|null $id
     * @param string $name
     * @param string $email
     * @param string $password
     */

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return UserQuiz
     */
    public function setName(string $name): UserQuiz
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return UserQuiz
     */
    public function setEmail(string $email): UserQuiz
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return UserQuiz
     */
    public function setPassword(string $password): UserQuiz
    {
        $this->password = $password;
        return $this;
    }
}