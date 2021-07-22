<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Resources\PublicUserResource;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()) {
            return new PublicUserResource($request->user());
        } else return null;
    }
}
