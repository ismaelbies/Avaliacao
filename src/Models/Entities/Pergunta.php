<?php


namespace App\Models\Entities;

/**
 * @Entity @Table(name="perguntas")
 * @ORM @Entity(repositoryClass="App\Models\Repository\PerguntaRepository")
 */
class Pergunta
{
    /**
     * @Id @GeneratedValue @Column(type="integer")
     */
    private ?int $id = null;

    private string $descricao = '';

    private Professor $professor;

    private string $dificuldade = '';

    private string $alternativa1 = '';

    private string $alternativa2 = '';

    private string $alternativa3 = '';

    private string $alternativa4 = '';

    private string $alternativa5 = '';
}