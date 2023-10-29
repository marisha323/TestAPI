<?php

namespace App\Contracts;

use http\Client\Request;
use PhpParser\Builder\Interface_;

Interface LinkContract
{
    public function create($url);
    public function status($id);
}
