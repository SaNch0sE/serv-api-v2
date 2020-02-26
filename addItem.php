<?php
	require_once "log.php";
	require_once "err-handler.php";
	require_once 'getUserId.php';
	$uid = getUserId();
	if ($uid >= 0 && !$uid) {
		require "GetTasks.php";
		if (is_array($tasks)) {
			$id = end($tasks)['id']+1;
		} else {
			$id = 0;
		}
		$data = json_decode(file_get_contents('php://input'), true);
		require_once "val.php";
		validate("addItem", $data);
		$text = $data['text'];
		$tasks[$id] = ['id' => $id, 'text' => $text, 'checked' => false];
		file_put_contents($filename, json_encode($tasks));
		echo json_encode(['id' => $id]);
	} else {
		header('Content-Type: application/json');
		echo json_encode(array('error' => "Error when processing user id"));
	}