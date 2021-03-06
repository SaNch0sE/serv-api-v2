<?php
	//require_once "log.php";
	require_once "err-handler.php";
	require_once 'getUserId.php';
	$output['ok'] = false;
	$i = 0;
	$data = json_decode(file_get_contents('php://input'), true);
	require_once 'val.php';
	validate("deleteItem", $data);
	$id = $data['id'];
	$uid = getUserId();
	if (strlen($uid) > 0) {
		require "GetTasks.php";
		foreach ($tasks as $key => $subArr) {
			if ($subArr['id'] === intval($id)) {
				unset($tasks[$i]);
				$output['ok'] = true;
			}
			$i += 1;
		}
		$tasks = array_values($tasks);
		file_put_contents($uid.'.json', json_encode($tasks));
		echo json_encode($output);
	} else {
		throw array('error' => "Error when processing user id");
	}