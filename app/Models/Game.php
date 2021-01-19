<?php

namespace App\Models;

class Game
{
    public $id;
    public $name;
    public $released;

    public function __construct($id, $name, $released) {
        $this->id = $id;
        $this->name = $name;
        $this->released = $released;
    }
}
