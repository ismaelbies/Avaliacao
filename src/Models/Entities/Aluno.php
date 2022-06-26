<?php


namespace App\Models\Entities;


class Aluno extends UserQuiz
{
    public string $matricula = '';

    public function __construct(string $name, string $email, string $password)
    {
        parent::__construct($name, $email, $password);
    }

    public function getMatricula(): string
    {
        return $this->matricula;
    }

    public function setMatricula(string $matricula): Aluno
    {
        $this->matricula = $matricula;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Aluno
     */
    public function setId(?int $id): Aluno
    {
        $this->id = $id;
        return $this;
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
     * @return Aluno
     */
    public function setName(string $name): Aluno
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
     * @return Aluno
     */
    public function setEmail(string $email): Aluno
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
     * @return Aluno
     */
    public function setPassword(string $password): Aluno
    {
        $this->password = $password;
        return $this;
    }


}