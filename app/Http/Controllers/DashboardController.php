<?php

namespace App\Http\Controllers;

use App\CollegeDegree;
use App\Country;
use App\Role;
use App\User;

class DashboardController extends Controller
{
    public function index()
    {
        $countries = Country::all();

        $roles = Role::all();

        return view("dashboards.index")->with([
            "degrees" => CollegeDegree::all(),
            "countries" => $countries,
            "user" => auth()
                ->user()
                ->load("details"),
            "roles" => $roles,
        ]);
    }
}
