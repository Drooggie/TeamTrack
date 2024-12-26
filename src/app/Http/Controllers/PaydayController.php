<?php

namespace App\Http\Controllers;

use App\Actions\Department\PaydayAction;
use Illuminate\Http\Request;

class PaydayController extends Controller
{
    public function __construct(
        private PaydayAction $paydayAction
    ) {}

    public function store()
    {
        $this->paydayAction->execute();
    }
}
