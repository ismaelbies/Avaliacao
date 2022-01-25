<?php

namespace App\Controllers;

use App\Helpers\Utils;
use App\Models\Entities\Address;
use App\Models\Entities\ChangeEmail;
use App\Models\Entities\City;
use App\Models\Entities\Employee;
use App\Models\Entities\State;
use App\Models\Entities\Transaction;
use App\Models\Entities\User;
use App\Models\Entities\UserAdmin;
use App\Services\Email;
use Doctrine\ORM\EntityManager;
use App\Models\Entities\Candidate;
use App\Models\Entities\Transactions;
use App\Models\Entities\PersonCreditCard;
use App\Models\Entities\PersonSignature;
use App\Models\Entities\Directory;
use App\Models\Entities\Communicated;
use App\Services\NovoService;
use App\Helpers\Session;
use Slim\Views\PhpRenderer;

abstract class Controller
{
    protected $em;
    protected $renderer;
    protected $baseUrl = BASEURL;
    protected $env = ENV;

    public function __construct(EntityManager $entityManager, PhpRenderer $renderer)
    {
        $this->em = $entityManager;
        $this->renderer = $renderer;
    }

    protected function getConfigs() {
        $config = parse_ini_file('configs.ini', true);
        return $config[$config['environment']];
    }


    protected function redirect(string $url = '')
    {
        header("Location: {$this->baseUrl}{$url}");
        die();
    }

    protected function redirectByPermissions($url = ''){
        Session::set('errorMsg', 'Você não tem permissão para acessar esse conteúdo.');
        header("Location: {$this->baseUrl}{$url}");
        die();
    }


}