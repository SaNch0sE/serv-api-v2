<?php
    function validate($action, $data)
    {
        if ($action === "login" || $action === "register") {
            if (isset($data["login"]) && isset($data["password"])) {
                return true;
            } else {
                throw new Exception("Bad input data", 422);
            }
        } elseif ($action === "addItem") {
            if (isset($data["text"]) && strlen($data["text"]) >= 1) {
                return true;
            } else {
                throw new Exception("Bad input data", 422);
            }
        }
    }