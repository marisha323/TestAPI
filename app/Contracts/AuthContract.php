<?php

namespace App\Contracts;


use PhpParser\Builder\Interface_;

Interface AuthContract
{
    public function loginUser($input,$credetials);
    public function registerUser($request);
}
