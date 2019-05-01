<?php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Weather\Controller\StartPage;

$request = Request::createFromGlobals();

$loader = new FilesystemLoader('View', __DIR__ . '/src/Weather');
$twig = new Environment($loader, ['cache' => __DIR__ . '/cache', 'debug' => true]);

$controller = new StartPage();

$src = $request->get('src');
$url = strtok($request->getRequestUri(), '?');
switch ($url) {
    case '/nfq/oop-weather/index.php/week':
        $renderInfo = $controller->getWeekWeather($src);
        break;
    case '/':
    default:
        $renderInfo = $controller->getTodayWeather($src);
        break;
}
//$renderInfo['context']['resources_dir'] = 'src/Weather/Resources';
$renderInfo['context']['resources_dir'] = '/nfq/oop-weather/src/Weather/Resources/';

$content = $twig->render($renderInfo['template'], $renderInfo['context']);

$response = new Response(
    $content,
    Response::HTTP_OK,
    array('content-type' => 'text/html')
);
$response->send();
