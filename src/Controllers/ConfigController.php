<?php

namespace DevbShrestha\Theme\Controllers;

use App\Http\Controllers\Controller;
use DevbShrestha\Theme\Traits\FileUpload;
use File;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    use FileUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(!auth()->user()->can('config'), 403);

        return view('theme::config.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(!auth()->user()->can('config'), 403);
        $config = [];
        $himalayan_bank = [
            'merchantID' => $request->himalayan_bank_merchantID,
            'currencyCode' => $request->himalayan_bank_currencyCode,
            'nonSecure' => $request->himalayan_bank_nonSecure,
            'secretKey' => $request->himalayan_bank_secretKey,
            'sandbox' => $request->himalayan_bank_sandbox ?? false,
            'live_url' => $request->himalayan_bank_live_url,
            'sandbox_url' => $request->himalayan_bank_sandbox_url,
            'logo' => $request->himalayan_bank_logo ? $this->uploadFile('logo', $request->himalayan_bank_logo) : config('config.himalayan_bank.logo') ?? '',
        ];
        $config['himalayan_bank'] = $himalayan_bank;
        $text = "<?php\n\nreturn " . var_export($config, true) . ";";

        File::put(base_path('config/config.php'), $text);
        return redirect()->back()->with('success', 'Successfully Updated..');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
