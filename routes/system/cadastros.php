<?php

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/cadastros/aluno/', fn(Request $request, Response $response) => $this->AlunoController->index($request, $response));
$app->get('/cadastros/professor/', fn(Request $request, Response $response) => $this->ProfessorController->index($request, $response));
