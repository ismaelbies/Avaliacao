<?php


namespace App\Models\Entities;
/**
 * @Entity @Table(name="resultadoQuiz")
 * @ORM @Entity(repositoryClass="App\Models\Repository\ResultadoQuizRepository")
 */


class ResultadoQuiz
{
    /**
     * @Id @GeneratedValue @Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ManyToOne(targetEntity="Quiz")
     * @JoinColumn(name="quiz", referencedColumnName="id")
     */
    private Quiz $quiz;

    /**
     * @ManyToOne(targetEntity="UserQuiz")
     * @JoinColumn(name="user", referencedColumnName="id")
     */
    private UserQuiz $userQuiz;

    /**
     * @Column(type="integer")
     */
    private int $result = 0;

    /**
     * @Column(type="datetime")
     */
    private \DateTime $created;

    public function __construct()
    {
        $this->created = new \DateTime();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Quiz
     */
    public function getQuiz(): Quiz
    {
        return $this->quiz;
    }

    /**
     * @param Quiz $quiz
     * @return ResultadoQuiz
     */
    public function setQuiz(Quiz $quiz): ResultadoQuiz
    {
        $this->quiz = $quiz;
        return $this;
    }

    /**
     * @return UserQuiz
     */
    public function getUserQuiz(): UserQuiz
    {
        return $this->userQuiz;
    }

    /**
     * @param UserQuiz $userQuiz
     * @return ResultadoQuiz
     */
    public function setUserQuiz(UserQuiz $userQuiz): ResultadoQuiz
    {
        $this->userQuiz = $userQuiz;
        return $this;
    }

    /**
     * @return int
     */
    public function getResult(): int
    {
        return $this->result;
    }

    /**
     * @param int $result
     * @return ResultadoQuiz
     */
    public function setResult(int $result): ResultadoQuiz
    {
        $this->result = $result;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     * @return ResultadoQuiz
     */
    public function setCreated(\DateTime $created): ResultadoQuiz
    {
        $this->created = $created;
        return $this;
    }
}