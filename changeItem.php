<?php
	require_once 'err-handler.php';
	require_once 'getUserId.php';
	$uid = getUserId();
	if ($uid >= 0 && $uid) {
		require_once 'GetTasks.php';
		$data = json_decode(file_get_contents('php://input'), true);
		require_once 'val.php';
		validate("changeItem", $data);
		$id = $data['id'];
		$checked = $data['checked'];
		$text = $data['text'];
		$output['ok'] = false;
		$i = 0;
		foreach ($tasks as $key => $value) {
			if ($value['id'] === intval($id)) {
				$tasks[$i] = ['id' => intval($id), 'text' => $text, 'checked' => filter_var($checked, FILTER_VALIDATE_BOOLEAN)];
				$output['ok'] = true;
				break;
			}
			$i += 1;
		}
		$tasks = array_values($tasks);
		file_put_contents($uid.'.json', json_encode($tasks));
		echo json_encode($output);
	} else {
		throw array('error' => "Error when processing user id");
	}