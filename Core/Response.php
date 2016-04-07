<?php

namespace Sanja\Core;

class Response {
    public function redirect($location) {
        header('Location: ' . $location);
    }
}