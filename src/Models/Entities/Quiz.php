<?php


namespace App\Models\Entities;
/**
 * @Entity @Table(name="quiz")
 * @ORM @Entity(repositoryClass="App\Models\Repository\QuizRepository")
 */

class Quiz
{
    /**
     * @Id @GeneratedValue @Column(type="integer")
     */
    private ?int $id = null;
}