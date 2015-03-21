<?php
ini_set('display_errors', 'on');
error_reporting(E_ALL);
ini_set("log_errors", 1);

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/vendor/datadog/php-datadogstatsd/libraries/datadogstatsd.php';
DataDogStatsD::increment('your.data.point');
DataDogStatsD::increment('your.data.point', .5);
DataDogStatsD::increment('your.data.point', 1, array('tagname' => 'value'));

$start_time = microtime(true);
run_function();
DataDogStatsD::timing('your.data.point', microtime(true) - $start_time);

DataDogStatsD::timing('your.data.point', microtime(true) - $start_time, 1, array('tagname' => 'value'));

$apiKey = 'myApiKey';
$appKey = 'myAppKey';

DataDogStatsD::configure($apiKey, $appKey);
DataDogStatsD::event('A thing broke!', array(
    'alert_type'      => 'error',
    'aggregation_key' => 'test_aggr'
));
DataDogStatsD::event('Now it is fixed.', array(
    'alert_type'      => 'success',
    'aggregation_key' => 'test_aggr'
));




use Swagger\Annotations as SWG;

$app = new Silex\Application();
$app['debug'] = true;

$app->register(new Silex\Provider\ServiceControllerServiceProvider());

$app->register(new JDesrosiers\Silex\Provider\SwaggerServiceProvider(), array(
    "swagger.srcDir" => __DIR__ . "/vendor/zircote/swagger-php/library",
    "swagger.servicePath" => __DIR__ . "/",
));


$app->register(new SwaggerUI\Silex\Provider\SwaggerUIServiceProvider(), array(
    'swaggerui.path'       => '/doc',
    'swaggerui.apiDocPath' => '/docs'
));
        
require_once ('services/routes/cardRoutes.php');

$app->run();
