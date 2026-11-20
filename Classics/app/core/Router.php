<?php

namespace app\core;

use Exception;
use app\services\EmpresaService;
use app\services\UsuarioService;

class Router
{
    private array $routes = [];

    public function get($route, $action){

        $this->routes[] = [
            'method' => 'get',
            'route' => $route,
            'action' => $action
        ];
    }

    public function post($route, $action){

        $this->routes[] = [
            'method' => 'post',
            'route' => $route,
            'action' => $action
        ];
    }


    public function run()
    {
        $uri  = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = strtolower($_SERVER['REQUEST_METHOD']);

        // Conta excluída pelo administrador enquanto estava logada: encerra a sessão
        if (!$this->contaLogadaExiste()) {
            session_unset();
            session_destroy();
            header('location: ' . URL_BASE . '/login');
            exit();
        }

        // O administrador só acessa o próprio painel, as notificações e o logout
        if (isset($_SESSION['admin_logado']) && !$this->rotaPermitidaAoAdmin((string) $uri)) {
            header('location: ' . URL_BASE . '/admin');
            exit();
        }

        foreach ($this->routes as $route) {
        
            if ($route['route'] == $uri && $route['method'] == $method) {
                
                return $this->dispatch($route);
            }
        }

        http_response_code(404);
        exit('Rota não encontrada');
    }

    public function dispatch($route){

        list($controller, $method) = explode('@', $route['action']);

        $controllerClass = "app\\controllers\\$controller";

        if (!class_exists($controllerClass)) {
            print "Controller $controller não encontrado";
            die;
        }

        if (!method_exists($controllerClass, $method)) {
            print "Método $method não encontrado em $controllerClass";
            die;
        }
        
        $controller = new $controllerClass;
        $controller->$method();

    }

    private function rotaPermitidaAoAdmin(string $uri): bool
    {
        // Cadastro, edição, exclusão e lista de atividades da empresa escolhida no painel
        $rotasAtividades = [
            '/empresa/atividades', '/atividade/ver',
            '/atividade/cadastrar', '/atividade/salvar',
            '/atividade/localizacao/cadastrar', '/atividade/localizacao/salvar',
            '/atividade/sessao/cadastrar', '/atividade/sessao/salvar', '/atividade/cadastro/concluir',
            '/atividade/editar', '/atividade/atualizar', '/atividade/excluir',
            '/atividade/sessao/edicao/salvar', '/atividade/sessao/edicao/atualizar', '/atividade/sessao/edicao/excluir'
        ];

        return $uri === '/admin'
            || str_starts_with($uri, '/admin/')
            || in_array($uri, ['/logout', '/notificacao/abrir', '/notificacao/lidas'], true)
            || in_array($uri, $rotasAtividades, true);
    }

    private function contaLogadaExiste(): bool
    {
        foreach (['usuario_logado', 'admin_logado'] as $chave) {
            if (isset($_SESSION[$chave]) && is_object($_SESSION[$chave])) {
                return (bool) (new UsuarioService())->getUsuarioById((int) $_SESSION[$chave]->getIdUsuario());
            }
        }

        if (isset($_SESSION['empresa_logada']) && is_object($_SESSION['empresa_logada'])) {
            return (bool) (new EmpresaService())->getEmpresa((int) $_SESSION['empresa_logada']->getIdEmpresa());
        }

        return true;
    }

    public function getAllRoutes(){
        return $this->routes;
    }

}
