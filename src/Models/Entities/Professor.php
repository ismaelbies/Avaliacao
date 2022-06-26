<?php


namespace App\Models\Entities;

/**
 * @Entity @Table(name="professores")
 * @ORM @Entity(repositoryClass="App\Models\Repository\ProfessorRepository")
 */
class Professor extends UserQuiz
{
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Professor
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): Professor
    {
        $this->password = $password;
        return $this;
    }


}