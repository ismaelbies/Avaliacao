<?php


namespace App\Controllers;


use App\Models\Entities\UserQuiz;
use Slim\Http\Request;
use Slim\Http\Response;

class RegisterController extends Controller
{
    public function registerUsuario(Request $request, Response $response) {
        try {
            $data = (array)$request->getParams();
            $user = new UserQuiz();
            $user->setEmail($data['email'])
                ->setMatricula($data['matricula'] ?? '')
                ->setName($data['name'])
                ->setPassword($data['password'])
                ->setTipoUsuario($data['tipo']);
            $this->em->getRepository(UserQuiz::class)->save($user);
            return $response->withJson([
                'status' => 'ok',
                'message' => 'Usuário cadastrado com sucesso!'
            ])->withHeader('Content-Type','application/json');
        } catch (\Exception $e) {
            return $response->withJson([
                'status' => 'error',
                'message' => $e->getMessage()
            ])->withStatus(500);
        }
    }

    public function getUsuarios(Request $request, Response $response) {
        $tipo = $request->getAttribute('route')->getArgument('tipo');
        $users = $this->em->getRepository(UserQuiz::class)->findBy(['tipoUsuario' => $tipo]);
        $array = [];
        foreach ($users as $u) {
            $array[] = ['id' => $u->getId(), 'name' => $u->getName(), 'email' => $u->getEmail(),
                'matricula' => $u->getMatricula(), 'tipo' => $u->getTipoUsuario()];
        }
        return $response->withJson([
            'status' => 'ok',
            'message' => $array,
        ])->withHeader('Content-Type','application/json');
    }
}