<?php
class Router
{
    private const METHOD_GET = 'GET';
    private const METHOD_POST = 'POST';
    public static $handlers = [];

    public static function get($path, $handler)
    {
        self::addHandler(self::METHOD_GET, $path, $handler);
        self::run();
    }

    public static function post($path, $handler)
    {
        self::addHandler(self::METHOD_POST, $path, $handler);
        self::run();
    }

    private static function addHandler($method, $path, $handler)
    {
        self::$handlers[$method . $path] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler,
        ];
    }

    private static function run()
    {
        $requestUrl = parse_url($_SERVER['REQUEST_URI']);
        $path = $requestUrl['path'];
        $method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$handlers as $handler) {
            if ($path === $handler['path'] && $method === $handler['method']) {
                call_user_func($handler['handler']);
            }
        }
    }
}
