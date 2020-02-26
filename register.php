<?php
	require_once "err-handler.php";
	require_once "val.php";
	// Get all users
	$filename = 'users.json';
    if (file_exists($filename)) {
        $users = json_decode(file_get_contents($filename), true);
    } else {
        file_put_contents($filename, "");
        $users = json_decode(file_get_contents($filename), true);
    }
	$output['ok'] = true;
	// Get POST data
	$data = json_decode(file_get_contents('php://input'), true);
	try {
		validate($data);
	} catch(Exception $e) {
		echo json_encode(array('error' => $e));
		return false;
	}
	if (isset($users[0]['id'])) {
		foreach ($users as $arr => $subArr) {
			if ($subArr['login'] === $data['login']) {
				$output['ok'] = false;
				break;
			}
		}
		if ($output['ok']) {
			$data['id'] = end($users)['id']+1;
			$data['user-key'] = null;
			$users[$data['id']] = $data;
			file_put_contents('users.json', json_encode($users));
		}
	} else {
		$data['id'] = 0;
		$data['user-key'] = null;
		$users[0] = $data;
		file_put_contents('users.json', json_encode($users));
	}
	echo json_encode($output);