<?php
	function getUserId()
	{
		$users = json_decode(file_get_contents('users.json'), true);
		if (!isset($_COOKIE['user-key'])) {
			return false;
		}
		foreach ($users as $key => $value) {
			require_once "log.php";
			mlog($_COOKIE['user-key']);
			if ($value['user-key'] === $_COOKIE['user-key']) {
				return $value['id'];
			}
		}
		return false;
	}