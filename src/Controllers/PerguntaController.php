<?php


namespace App\Controllers;
use App\Models\Entities\Pergunta;
use Slim\Http\Request;
use Slim\Http\Response;

class PerguntaController extends Controller
{
    public function index(Request $request, Response $response) {
        return $this->renderer->render($response, 'default.phtml', ['page' => 'cadastros/pergunta.phtml']);
    }

    public function registerPerguntaIndex(Request $request, Response $response) {
        return $this->renderer->render($response, 'default.phtml', ['page' => 'cadastros/pergunta-form.phtml']);
    }

    public function registerPergunta(Request $request, Response $response) {
        try {
            $data = (array)$request->getParams();
            $pergunta = new Pergunta();
            $pergunta->setAlternativa1($data['alternativa1'])
                ->setAlternativa2($data['alternativa2'])
                ->setAlternativa3($data['alternativa3'])
                ->setAlternativa4($data['alternativa4'])
                ->setAlternativa5($data['alternativa5'])
                ->setDescricao($data['descricao'])
                ->setDificuldade($data['dificuldade'] ?? '')
                ->setProfessor(null);
            $this->em->getRepository(Pergunta::class)->save($pergunta);
            return $response->withJson([
                'status' => 'ok',
                'message' => 'Pergunta cadastrado com sucesso'
            ])->withHeader('Content-Type','application/json');
        } catch (\Exception $e) {
            return $response->withJson([
                'status' => 'error',
                'message' => $e->getMessage()
            ])->withStatus(500);
        }
    }
}