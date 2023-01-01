<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {

        $data = User::with('roles')->get();

        return view('admin.pages.users')->with(['data' => $data]);
    }

    public function destroy($userId)
    {
        $data = User::find($userId);

        if ($data->id == Auth::user()->id) {
            return redirect()->back()->with(['errors' => 'This is a message!']);
        } else {
            $data->delete();
            return redirect(route('user.index'));
        }
    }
}
