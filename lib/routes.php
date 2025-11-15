<?php
require "lib/controllers.php";
require "controllers/main_controller.php";
require "controllers/google_controller.php";

function clearUrl($path)
{
    $pos = strpos($path, $_ENV['proyekname']);
    if ($pos !== false) {
        $path = substr($path, $pos + strlen($_ENV['proyekname']));
    }
    if ($path === '' || $path === false) {
        $path = '/';
    }
    return $path;
}

class Routes
{
    private $route = [];
    private $request_url;
    public function __construct()
    {
        $this->request_url =  parse_url($_SERVER['REQUEST_URI']);
    }
    public function GET($url, $controller)
    {
        $this->route[] = ["URL" =>  $url, "Controller"  => $controller, "Method" =>  "GET"];
    }

    public function POST($url, $controller)
    {
        $this->route[] = ["URL" =>  $url, "Controller"  => $controller, "Method" =>  "POST"];
    }

    public function JalankanRouting()
    {
        foreach ($this->route as $route) {
            $url_path = clearUrl(strtolower($this->request_url["path"]));
            $url = $route['URL'];
            if ($url == $url_path && $route['Method'] == $_SERVER['REQUEST_METHOD']) {
                list($className, $methodName) = explode("@", $route['Controller']);
                if (class_exists($className)) {
                    $controller = new $className;
                    if (method_exists($controller, $methodName)) {
                        $controller->$methodName();
                        return;
                    }
                }
            }
        }
        echo "404 Not Found!";
    }
}
