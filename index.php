<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Tasks\Helper\SessionHelper;
use Tasks\Controller\AddController;
use Tasks\Controller\BaseController;
use Tasks\Controller\CompleteController;
use Tasks\Controller\EditController;
use Tasks\Controller\IndexController;
use Tasks\Controller\LoginController;
use Tasks\Controller\LogoutController;

$config = array_merge(require 'config/config.php', require 'config/config-local.php');

$capsule = new Capsule;
$capsule->addConnection($config['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$session = SessionHelper::getInstance();
$session->configure($config['admin']);

switch ($_GET['action'] ?? 'index') {
    case 'add':
        $actionClass = AddController::class;
        break;
    case 'login':
        $actionClass = LoginController::class;
        break;
    case 'logout':
        $actionClass = LogoutController::class;
        break;
    case 'complete':
        $actionClass = CompleteController::class;
        break;
    case 'edit':
        $actionClass = EditController::class;
        break;
    default:
        $actionClass = IndexController::class;
        break;
}

$action = new $actionClass();

/**
 * @var BaseController $action
 */
echo $action->executeWithLayout();

