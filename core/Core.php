<?php
class Core {
    public function run($routes) {
        $url = isset($_GET['url']) ? '/' . $_GET['url'] : '/';
        $urlPath = parse_url($url, PHP_URL_PATH);

        $routerFound = false;

        foreach ($routes as $path => $controller) {
            $pattern = '#^' . preg_replace('/\{(\w+)\}/', '(\w+)', strtok($path, '?')) . '$#';

            if (preg_match($pattern, $urlPath, $matches)) {
                array_shift($matches);

                $routerFound = true;

                [$currentController, $action] = explode('@', $controller);
                require_once __DIR__ . "/../controllers/$currentController.php";

                $newController = new $currentController();

                $queryParams = [];
                if (isset($_SERVER['QUERY_STRING'])) {
                    parse_str($_SERVER['QUERY_STRING'], $queryParams);
                }

                $params = array_merge($matches, $queryParams);
                $reflection = new ReflectionMethod($newController, $action);
                $orderedParams = array_map(fn($param) => $params[$param->getName()] ?? array_shift($params), $reflection->getParameters());

                call_user_func_array([$newController, $action], $orderedParams);
                return;
            }
        }

        if(!$routerFound) {
            require_once __DIR__ . "/../controllers/NotFoundController.php";
            $controller = new NotFoundController();
            $controller->index();
        }

    }
}
