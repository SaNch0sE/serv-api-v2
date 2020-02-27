<?php
	//require_once "log.php";
	require_once "err-handler.php";
	require_once 'getUserId.php';
	$uid = getUserId();
	if (strlen($uid) > 0) {
		require "GetTasks.php";
		if ($tasks != null) {
			$data['items'] = $tasks;
		} else {
			$data['items'] = [];
		}
		echo json_encode($data);
	} else {
		header('Content-Type: application/json');
		echo json_encode(array('error' => "Error when processing user id"));
	}