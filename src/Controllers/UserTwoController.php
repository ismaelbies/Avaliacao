<?php


namespace App\Controllers;


use App\helpers\Validator;
use App\Models\Entities\User;
use Slim\Http\Request;
use Slim\Http\Response;

class UserTwoController extends Controller
{
    public function index(Request $request, Response $response) {
        return $this->renderer->render($response, 'default.phtml', ['page' => 'user/indexUser.phtml']);
    }

    private function validateEmail($email) {
        $regex = "/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/";
        $regex2 = "/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3}+(\.)+[a-zA-Z]{2})$/";
        if(!preg_match($regex, $email) && !preg_match($regex2, $email)) throw new \Exception('Email inválido');
        return $email;
    }

    public function savePhoto(Request $request, Response $response) {
        try {
            set_time_limit(0);
            ini_set("memory_limit", -1);
            ignore_user_abort(1);
            $userId = $request->getParam('user');
            $user = $this->em->getRepository(User::class)->find($userId);
            $ext = strtolower(substr($_FILES['file']['name'],-4)); //Pegando extensão do arquivo
            if($ext != '.png' && $ext != '.jpeg' && $ext != '.jpg') throw new \Exception('Formato inválido');
            $new_name = $user->getName() . '_' . $userId . $ext; //Definindo um novo nome para o arquivo
            $dir = 'arquivos/'; //Diretório para uploads
            move_uploaded_file($_FILES['file']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo
            return $response->withJson([
                'status' => 'ok',
                'message' => 'Imagem salva com sucesso.'
            ], 201)->withHeader('Content-Type','application/json');
        } catch (\Exception $e) {
            return $response->withJson([
                'status' => 'error',
                'message' => $e->getMessage(),
            ])->withStatus(500);
        }

    }

    public function registerUser(Request $request, Response $response) {
        try {
            $this->em->beginTransaction();
            $data = (array)$request->getParams();
            //Validação
            $fields = [
                'name' => 'Nome',
                'email' => 'Email',
                ];
            Validator::requireValidator($fields, $data);
            $this->validateEmail($data['email']);
            $user = new User();
            if($data['userId'] > 0) {
                $user = $this->em->getRepository(User::class)->find($data['userId']);
            }
            $user->setEmail($data['email'])
                ->setName($data['name'])
                ->setPhone($data['phone']);
            $this->em->getRepository(User::class)->save($user);
            $this->em->commit();
            return $response->withJson([
                'status' => 'ok',
                'message' => 'Usuário cadastrado com sucesso.'
            ], 201)->withHeader('Content-Type','application/json');
        } catch (\Exception $e) {
            $this->em->rollback();
            return $response->withJson([
                'status' => 'error',
                'message' => $e->getMessage(),
            ])->withStatus(500);
        }
    }

    public function deleteUser(Request $request, Response $response) {
        try {
            $this->em->beginTransaction();
            $id = $request->getAttribute('route')->getArgument('id');
            $this->em->getRepository(User::class)->deleteById($id);
            $this->em->commit();
            return $response->withJson([
                'status' => 'ok',
                'message' => 'Usuário removido com sucesso.'
            ], 201)->withHeader('Content-Type','application/json');
        } catch (\Exception $e) {
            $this->em->rollback();
            return $response->withJson([
                'status' => 'error',
                'message' => $e->getMessage(),
            ])->withStatus(500);
        }
    }

    public function getUsers(Request $request, Response $response) {
        $id = $request->getAttribute('route')->getArgument('id');
        $filter = (array)$request->getParams();
        $index = $request->getParam('index');
        $users = $this->em->getRepository(User::class)->list(20, 20 * $index, $filter, $id);
        $partial = count($users);
        $total = $this->em->getRepository(User::class)->countUsers($filter);
        return $response->withJson([
            'status' => 'ok',
            'message' => $users,
            'partial' => $partial,
            'total' => $total,
        ], 200)->withHeader('Content-Type', 'application/json');
    }
}