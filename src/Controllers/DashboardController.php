<?php
namespace DevbShrestha\Theme\Controllers;

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
        if (count(auth()->user()->getRoleNames()) == 1 && auth()->user()->hasRole('user')) {
            abort(403);
        }
        return view('theme::index');

    }

    public function menu()
    {

    }

}
