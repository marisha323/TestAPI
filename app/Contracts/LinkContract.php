<?php

namespace App\Contracts;


use PhpParser\Builder\Interface_;

Interface LinkContract
{
    public function create($url);
    public function status($id);
}
