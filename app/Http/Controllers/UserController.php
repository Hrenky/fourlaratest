<?php

namespace App\Http\Controllers;

use App\Helpers\Connector;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(
        public Connector $connector
    ) {}

    public function profile(): View
    {
        $response = $this->connector->connect('get', 'me');

        return view('pages.profile', $response);
    }
}
