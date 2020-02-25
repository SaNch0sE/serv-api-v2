<?php
	require_once "err-handler.php";
	$data = json_decode(file_get_contents('php://input'), true);
	$users = json_decode(file_get_contents('users.json'), true);
	$output['ok'] = true;
	foreach ($users as $arr => $subArr) {
		if ($subArr['login'] === $data['login']) {
			$output['ok'] = false;
			break;
		}
	}
	if ($output['ok'] && isset(end($users)['id'])) {
		$data['id'] = end($users)['id']+1;
		$data['user-key'] = null;
		$users[$data['id']] = $data;
		file_put_contents('users.json', json_encode($users));
	} elseif ($output['ok']) {
		$data['id'] = 0;
		$users[0] = $data;
		file_put_contents('users.json', json_encode($users));
	}
	echo json_encode($output);