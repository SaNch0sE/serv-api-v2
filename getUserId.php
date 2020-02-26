<?php
	function getUserId()
	{
		$users = json_decode(file_get_contents('users.json'), true);
		foreach ($users as $key => $value) {
			require_once "log.php";
			mlog($value['user-key']);
			if ($value['user-key'] === $_COOKIE['user-key']) {
				return $value['id'];
			}
		}
		return false;
	}