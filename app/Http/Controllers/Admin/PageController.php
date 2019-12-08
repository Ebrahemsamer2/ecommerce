<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index(string $page)
    {
        if (view()->exists("admin.pages.{$page}")) {
            return view("admin.pages.{$page}");
        }
        return abort(404);
    }
}
