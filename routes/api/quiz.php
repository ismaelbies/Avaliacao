<?php

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/api/quiz/', fn(Request $request, Response $response) => $this->QuizController->getQuiz($request, $response));
