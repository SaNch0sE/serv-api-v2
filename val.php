<?php
    function validate($action, $data)
    {
        if ($action === "login" || $action === "register") {
            if (isset($data["login"]) && isset($data["pass"])) {
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
        } elseif ($action === "changeItem") {
            if (isset($data["text"]) && strlen($data["text"]) >= 1 && is_bool($data["checked"]) && isset($data["id"])) {
                return true;
            } else {
                throw new Exception("Bad input data", 422);
            }
        } elseif ($action === "deleteItem") {
            if (intval($data["id"]) >= 0) {
                return true;
            } else {
                throw new Exception("Bad input data", 422);
            }
        }
    }