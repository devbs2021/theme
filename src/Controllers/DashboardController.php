<?php
namespace Devbs\Theme\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{

    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        abort_if(!in_array('dashboard', json_decode(auth()->user()->permissions->permissions)), 403);

        return view('theme::index');
    }

    public function menu(){
        
    }

}
