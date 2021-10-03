<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;

class UsersController extends Controller
{
    /**
     * Get the list of all users
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (request()->has("type") && request("type") === "coworkers") {
            $users = User::whereHas("roles")->paginate(10);
        } else {
            if (request()->has("type") && request("type") === "customers") {
                $users = User::whereDoesntHave("roles")->paginate(10);
            } else {
                $users = User::paginate(10);
            }
        }

        $roles = Role::all();

        return view("admin.users.index", compact("users", "roles"));
    }

    /**
     * Update user details.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update()
    {
        $attributes = request()->validate([
            "name" => "required|string|max:255",
            "email" =>
                "required|string|email|max:255|unique:users,id," . auth()->id(),
            "phone_number" => "required",
        ]);

        auth()
            ->user()
            ->update($attributes);

        session()->flash("flash", "اطلاعات با موفقیت به روز رسانی شد.");

        return back();
    }

    /**
     * Delete a user from DB.
     *
     * @param        $locale
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * @throws \Exception
     */
    public function destroy($locale, User $user)
    {
        $user->delete();

        \session()->flash("حساب کاربری شما حذف شد.");

        return redirect(route("admin.users.index", $locale));
    }
}
