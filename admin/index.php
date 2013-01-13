<?php

// Fix redirect paths.
bind('controller', 'redirect', function ($uri)
{
	if ($uri[0] == '/' && strpos($uri, '/admin') === false)
	{
		return "/admin{$uri}";
	}
});

// Set layout.
if (!$request->ajax)
{
	$request->layout = "admin";
}

// Set path.
$request->path = 
	Request::$controller->path = 
		Request::$controller->view->path = "/admin/";

// Route admin view.
$args = args("uri*");
Request::$controller->route_view($args['uri']);

// Determine view path.
$view = str_replace(APP_ROOT.'app/templates/', '', $request->view);

// Render admin view.
render($view);