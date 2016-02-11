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

$container = \API\Container::obtemInstancia();

$mapper = $container->mapper;
$mapper->entityNamespace = '\\API\\Entities\\';

$router = $container->router;

// SESSAO
$router->get(BASE_URL . "public/sessao", "\\API\\Repositories\\SessaoRepository", array(
    $container->mapper
))->accept(array(
    'application/json' => function ($obj) {
        echo json_encode($obj);
    }
));

$router->post(BASE_URL . "public/sessao", "\\API\\Repositories\\SessaoRepository", array(
    $container->mapper
))->accept(array(
    'application/json' => function ($obj) {
        echo json_encode($obj);
    }
));

// USUARIO
$router->get(BASE_URL . "public/usuario/*", "\\API\\Repositories\\UsuarioRepository", array(
    $container->mapper
))->accept(array(
    'application/json' => function ($obj) {
        echo json_encode($obj);
    }
));

$router->post(BASE_URL . "public/usuario", "\\API\\Repositories\\UsuarioRepository", array(
    $container->mapper
))->accept(array(
    'application/json' => function ($obj) {
        echo json_encode($obj);
    }
));

// MODULO
$router->get(BASE_URL . "public/modulo/*", "\\API\\Repositories\\ModuloRepository", array(
    $container->mapper
))->accept(array(
    'application/json' => function ($obj) {
        echo json_encode($obj);
    }
));

$router->post(BASE_URL . "public/modulo", "\\API\\Repositories\\ModuloRepository", array(
    $container->mapper
))->accept(array(
    'application/json' => function ($obj) {
        echo json_encode($obj);
    }
));

// ATIVIDADE
$router->get(BASE_URL . "public/atividade/*", "\\API\\Repositories\\AtividadeRepository", array(
    $container->mapper
))->accept(array(
    'application/json' => function ($obj) {
        echo json_encode($obj);
    }
));

$router->post(BASE_URL . "public/atividade", "\\API\\Repositories\\AtividadeRepository", array(
    $container->mapper
))->accept(array(
    'application/json' => function ($obj) {
        echo json_encode($obj);
    }
));

echo $router->run();