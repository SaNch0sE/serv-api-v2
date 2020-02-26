<?php
	require_once "err-handler.php";
	require_once "val.php";
	$data = json_decode(file_get_contents('php://input'), true);
	try {
		validate("login", $data);
	} catch(Exception $e) {
		echo json_encode(array('error' => $e));
		return false;
	}
	$output['ok'] = false;
	$users = json_decode(file_get_contents('users.json'), true);
	$i = 0;
	foreach ($users as $arr => $subArr) {
		if ($subArr['login'] === $data['login'] && $subArr['password'] === $data['password']) {
			$users[$i]['user-key'] = md5($subArr['login'].$subArr['id']);
			file_put_contents('users.json', json_encode($users));
			setcookie('user-key', $users[$i]['user-key']);
			$output['ok'] = true;
		}
		$i += 1;
	}
	echo json_encode($output);