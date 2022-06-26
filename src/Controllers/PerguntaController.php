<?php


namespace App\Controllers;
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
}