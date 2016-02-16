<?php
define('BASE_URL', '/');
define('APPLICATION_PATH', dirname(realpath(__FILE__)) . '/../');
define('APPLICATION_ENVIRONMENT', 'desenvolvimento');

date_default_timezone_set("America/Sao_Paulo");

switch (APPLICATION_ENVIRONMENT) {
    case 'desenvolvimento':
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        break;
    case 'teste':
    case 'producao':
        error_reporting(0);
        break;
    default:
        exit('O ambiente do aplicativo não está definida corretamente .');
}

require_once (APPLICATION_PATH . 'vendor/autoload.php');

use API\Container;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$container = Container::obtemInstancia();

$paths = array(APPLICATION_PATH . "src/Entities");
$isDevMode = false;

$dbParams = array(
    'host'     => '192.168.20.110',
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => '',
    'dbname'   => 'angular',
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);

$router = $container->router;

// SESSAO
$router->get(BASE_URL . "public/sessao", "\\API\\Repositories\\SessaoRepository");

$router->post(BASE_URL . "public/sessao", "\\API\\Repositories\\SessaoRepository");

// USUARIO
$router->get(BASE_URL . "public/usuario/*", "\\API\\Repositories\\UsuarioRepository");

$router->post(BASE_URL . "public/usuario", "\\API\\Repositories\\UsuarioRepository");

// MODULO
$router->get(BASE_URL . "public/modulo/*", "\\API\\Repositories\\ModuloRepository");

$router->post(BASE_URL . "public/modulo", "\\API\\Repositories\\ModuloRepository");

// ATIVIDADE
$router->get(BASE_URL . "public/atividade/*", "\\API\\Repositories\\AtividadeRepository");

$router->post(BASE_URL . "public/atividade", "\\API\\Repositories\\AtividadeRepository");

$router->always('Accept', array(
    'application/json' => function ($response) {
        return json_encode($response);
    }
));

echo $router->run();