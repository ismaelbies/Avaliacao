<?php


namespace App\Controllers;
use App\Models\Entities\Aluno;
use App\Models\Entities\Pergunta;
use App\Models\Entities\UserQuiz;
use Slim\Http\Request;
use Slim\Http\Response;

class PerguntaController extends Controller
{
    public function index(Request $request, Response $response) {
        $user = $this->getLogged();
        return $this->renderer->render($response, 'default.phtml', ['page' => 'cadastros/pergunta.phtml',
            'user' => $user]);
    }

    public function registerPerguntaIndex(Request $request, Response $response) {
        $user = $this->getLogged();
        return $this->renderer->render($response, 'default.phtml', ['page' => 'cadastros/pergunta-form.phtml',
            'user' => $user]);
    }

    public function registerPergunta(Request $request, Response $response) {
        try {
            $user = $this->getLogged();
            $data = (array)$request->getParams();
            $pergunta = new Pergunta();
            $pergunta->setAlternativa1($data['alternativa1'])
                ->setAlternativa2($data['alternativa2'])
                ->setAlternativa3($data['alternativa3'])
                ->setAlternativa4($data['alternativa4'])
                ->setAlternativa5($data['alternativa5'])
                ->setAlternativaCorreta($data['alternativaCorreta'] ?? '')
                ->setDescricao($data['descricao'])
                ->setDificuldade($data['dificuldade'] ?? '')
                ->setProfessor($this->getLogged());

            $this->em->getRepository(Pergunta::class)->save($pergunta);
            return $response->withJson([
                'status' => 'ok',
                'message' => 'Pergunta cadastrada com sucesso!'
            ])->withHeader('Content-Type','application/json');
        } catch (\Exception $e) {
            return $response->withJson([
                'status' => 'error',
                'message' => $e->getMessage()
            ])->withStatus(500);
        }
    }

    public function getPerguntas(Request $request, Response $response) {
        $perguntas = $this->em->getRepository(Pergunta::class)->findAll();
        $array = [];
        foreach ($perguntas as $p) {
            $array[] = ['id' => $p->getId(),
                'professor' => $p->getProfessor() != null ? $p->getProfessor()->getName() : '---',
                'descricao' => $p->getDescricao(), 'dificuldade' => $p->getDificuldade()];
        }
        return $response->withJson([
            'status' => 'ok',
            'message' => $array,
        ])->withHeader('Content-Type','application/json');
    }
}