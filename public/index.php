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
use API\MyStyle;

$container = Container::obtemInstancia();

$mapper = $container->mapper;
$mapper->entityNamespace = '\\API\\Entities\\';
$mapper->setStyle(new MyStyle);

$router = $container->router;

// SESSAO
$router->get(BASE_URL . "public/sessao", "\\API\\Repositories\\SessaoRepository", array(
    $container->mapper
));

$router->post(BASE_URL . "public/sessao", "\\API\\Repositories\\SessaoRepository", array(
    $container->mapper
));

// USUARIO
$router->get(BASE_URL . "public/usuario/*", "\\API\\Repositories\\UsuarioRepository", array(
    $container->mapper
));

$router->post(BASE_URL . "public/usuario", "\\API\\Repositories\\UsuarioRepository", array(
    $container->mapper
));

// MODULO
$router->get(BASE_URL . "public/modulo/*", "\\API\\Repositories\\ModuloRepository", array(
    $container->mapper
));

$router->post(BASE_URL . "public/modulo", "\\API\\Repositories\\ModuloRepository", array(
    $container->mapper
));

// ATIVIDADE
$router->get(BASE_URL . "public/atividade/*", "\\API\\Repositories\\AtividadeRepository", array(
    $container->mapper
));

$router->post(BASE_URL . "public/atividade", "\\API\\Repositories\\AtividadeRepository", array(
    $container->mapper
));

$router->always('Accept', array(
    'application/json' => function ($response) {
        return json_encode($response);
    }
));

echo $router->run();