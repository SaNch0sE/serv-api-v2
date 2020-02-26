<?php
    function validate($action, $data)
    {
        if ($action === "login" || $action === "register") {
            if (isset($data["login"]) && isset($data["password"])) {
                return true;
            } else {
                throw new Exception("Error 422. Bad input data");
            }
        }
    }