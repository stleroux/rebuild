<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function dashboard()
    {
        return view('dashboard');
    }


##################################################################################################################
# ████████╗███████╗███████╗████████╗
# ╚══██╔══╝██╔════╝██╔════╝╚══██╔══╝
#    ██║   █████╗  ███████╗   ██║   
#    ██║   ██╔══╝  ╚════██║   ██║   
#    ██║   ███████╗███████║   ██║   
#    ╚═╝   ╚══════╝╚══════╝   ╚═╝  
##################################################################################################################
    public function test()
    {
        $users = User::all();
        return view('test', compact('users'));
    }


// STATISTICS
    public function stats()
    {
        $categoryCount = Category::count();
        $commentCount = Comment::count();
        $componentCount = \Module::count();
        $moduleCount = Module::count();
        $permissionCount = Permission::count();
        $postCount = Post::count();
        $recipeCount = Recipe::count();
        $userCount = User::count();

        $comments = Comment::all();
        $modules = Module::all();

        return view('stats.index', compact(
            'categoryCount','commentCount','componentCount','moduleCount','permissionCount','postCount','recipeCount','userCount',
            'comments','modules'
        ));
    }



}
