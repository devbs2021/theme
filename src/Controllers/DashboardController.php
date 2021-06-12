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

        return view('theme::index');

    }

    public function menu()
    {

    }

}
