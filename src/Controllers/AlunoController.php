<?php


namespace App\Controllers;


use Slim\Http\Request;
use Slim\Http\Response;

class AlunoController extends Controller
{

    public function index(Request $request, Response $response) {
        return $this->renderer->render($response, 'default.phtml', ['page' => 'cadastros/aluno.phtml']);
    }
}