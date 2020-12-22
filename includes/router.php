<?php
include __DIR__ . '/../vendor/autoload.php';
define('IS_DEBUG_ENABLED', FALSE);

$dispatcher = FastRoute\cachedDispatcher(function(FastRoute\RouteCollector $r) {

    $r->get('/', 'get_homepage');
    $r->addRoute('GET', '/project/{name}', 'get_project');

}, [
    'cacheFile' => __DIR__ . '/route.cache', /* required */
    'cacheDisabled' => IS_DEBUG_ENABLED,     /* optional, enabled by default */
]);



// Fetch method and URI from somewhere
$httpMethod = check_plain($_SERVER['REQUEST_METHOD']);
$uri = check_plain($_SERVER['REQUEST_URI']);

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}

$uri = check_plain(rawurldecode($uri));

//echo '<script>console.log("'.$uri.'")</script>';



$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        make_404();
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        http_response_code('405');
        echo '405 Method Not Allowed';
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        call_user_func_array($handler, $vars);
        break;
}

// ==== PAGE VARS ====
$options = array();

// ==== GENERATE PAGE ====
function page($content = null, $options = array()) {
  require('header.php');
  if($content != null) {
   require($content);
  }
  require('footer.php');
}

// ==== PAGES ====
function make_404() {
  http_response_code('404');
  $fast_404_html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><title>404 Not Found</title><style>h1,p{text-align:center;font-family: Georgia, serif;}</style></head><body><h1>Not Found</h1><p>The requested URL "@path" was not found on this server.</p></body></html>';
  // Replace @path in the variable with the page path.
  print strtr($fast_404_html, array('@path' => check_plain(request_uri())));
  exit;
}

function get_homepage() {

  $options = array();
  $options['page_title'] = 'Portfolio';
  $options['header_content'] = <<<EOT
  <div class="heading-wrapper w-container">
    <h1 class="main-heading">I am a frontend developer with backend expertise</h1>
    <a class="button w-button colorbox-trigger" data-name="contact" href="/contactform/index.html">Lets Chat</a>
  </div>
EOT;

  echo page('homecontent.php', $options);
}

function get_project($project_name) {
  require('projectcontent.php');
switch ($project_name) {
  case 'asp':
    $project = $asp;
    require('projecttemplate.php');
    break;

  case 'blood':
    $project = $blood;
    require('projecttemplate.php');
    break;

  case 'bob':
    $project = $bob;
    require('projecttemplate.php');
    break;

  case 'cl':
    $project = $cl;
    require('projecttemplate.php');
    break;

  case 'deluxe':
    $project = $deluxe;
    require('projecttemplate.php');
    break;

  case 'est':
    $project = $est;
    require('projecttemplate.php');
    break;

  case 'florastor':
    $project = $florastor;
    require('projecttemplate.php');
    break;

  case 'how':
    $project = $how;
    require('projecttemplate.php');
    break;

  case 'int':
    $project = $int;
    require('projecttemplate.php');
    break;

  case 'mc':
    $project = $mc;
    require('projecttemplate.php');
    break;

  case 'or':
    $project = $or;
    require('projecttemplate.php');
    break;

  case 'sbx':
    $project = $sbx;
    require('projecttemplate.php');
    break;

  case 'tni':
    $project = $tni;
    require('projecttemplate.php');
    break;

  case 'vm':
    $project = $vm;
    require('projecttemplate.php');
    break;

  case 'wildchild':
    $project = $wildchild;
    require('projecttemplate.php');
    break;

  default:
    echo 'I cannot find that project right now';
    break;
}

}
