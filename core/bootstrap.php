<?php

$app = require 'config.php';

require 'core/Loader.php';

require 'core/Model.php';
Core\Loader::models();

require 'core/database/Connection.php';
require 'core/database/QueryBuilder.php';
require 'core/Controller.php';
require 'core/ViewsHelper.php';
require 'core/routing/Route.php';
require 'core/routing/Router.php';
require 'core/Request.php';
require 'routes.php';


// define("PROJECT_DIR", dirname(__FILE__));
// define("MODELS_DIR", PROJECT_DIR . ' / models / ');
// define("VIEWS_DIR", PROJECT_DIR . ' / views / ');
// define("CONTROLLERS_DIR", PROJECT_DIR . ' / controllers / ');
// define("DATABASE_DIR", PROJECT_DIR . ' / database / ');
// define("PUBLIC_DIR", PROJECT_DIR . ' / database / ');
// define("STORAGE_DIR", PROJECT_DIR . ' / database /');
