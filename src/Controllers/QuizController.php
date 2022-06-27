<?php


namespace App\Controllers;
use App\Models\Entities\Pergunta;
use App\Models\Entities\PerguntaQuiz;
use App\Models\Entities\Quiz;
use Slim\Http\Request;
use Slim\Http\Response;

class QuizController extends Controller
{
    public function index(Request $request, Response $response) {
        $user = $this->getLogged();
        return $this->renderer->render($response, 'default.phtml', ['page' => 'quiz/index.phtml',
            'user' => $user]);
    }

    public function indexPergunta(Request $request, Response $response) {
        $id = $request->getAttribute('route')->getArgument('id');
        $user = $this->getLogged();
        $pergunta = $this->em->getRepository(Pergunta::class)->find($id);
        return $this->renderer->render($response, 'default.phtml', ['page' => 'quiz/indexPergunta.phtml',
            'user' => $user, 'pergunta' => $pergunta]);
    }

    public function getQuiz(Request $request, Response $response) {
        $quiz = $this->em->getRepository(Quiz::class)->findAll();
        $array = [];
        foreach ($quiz as $q) {
            $array[] = ['id' => $q->getId(), 'name' => $q->getName(), 'dificuldade' => $q->getDificuldade()];
        }
        return $response->withJson([
            'status' => 'ok',
            'message' => $array
        ])->withHeader('Content-Type','application/json');
    }
}