<?php
	function getUserId()
	{
		require_once "log.php";
		$users = json_decode(file_get_contents('users.json'), true);
		if (!isset($_COOKIE['user-key'])) {
			mlog($_COOKIE['user-key']);
			return false;
		}
		foreach ($users as $key => $value) {
			//mlog($_COOKIE['user-key']);
			if ($value['user-key'] === $_COOKIE['user-key']) {
				return $value['id'];
			}
		}
		return false;
	}