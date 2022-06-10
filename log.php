<?php

	require_once 'lib/Application.php';
	$o_Application = new Application();

	Application::redirect('/Sismissing/?ctrl=Login&act=siconnection&userId='.$_GET["userId"].'&appId='.$_GET["appId"]);
