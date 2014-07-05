<?php
require_once(dirname(__FILE__) . '/url_manager.php');

$urlManager = array(
    'urlManager' => array(
        'urlFormat' => 'path',
        'rules' => $urlRules,
        'caseSensitive' => false,
    ),
);

$bootstrap = array(
    'bootstrap' => array(
        'class' => 'bootstrap.components.TbApi',
    ),
);

$bootstrap_3 = array(
    'bootstrap_3' => array(
        'class' => 'bootstrap_3.components.BuckitBSP',
    ),
);

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'My Web Application',
    'aliases' => array(
        //'bootstrap' => realpath(__DIR__ . '/../extensions/bootstrap'),
        'bootstrap_3' => realpath(__DIR__ . '/../extensions/bootstrap_3'),
    ),
    'import' => array(
        'application.models.*',
        //'bootstrap.helpers.TbHtml',
    ),
    'components' => array_merge($urlManager, $bootstrap_3),
);