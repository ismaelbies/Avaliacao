<?php

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

$app->post('/api/cadastros/aluno/', fn(Request $request, Response $response) => $this->AlunoController->registerAluno($request, $response));

$app->get('/api/cadastros/aluno/', fn(Request $request, Response $response) => $this->AlunoController->getAlunos($request, $response));
