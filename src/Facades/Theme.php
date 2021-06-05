<?php

namespace DevbShrestha\Theme\Facades;

use DevbShrestha\Theme\Jobs\SendMailJob;
use DevbShrestha\Theme\Models\Setting;
use DevbShrestha\Theme\Models\Subscription;
use DevbShrestha\Theme\Requests\StoreSubscriptionRequest;
use File;

class Theme
{

    public function setting()
    {
        foreach ($this->packages() as $package) {
            $check = Setting::where('module', $package)->first();
            if (!$check) {
                Setting::create([
                    'module' => $package,
                    'status' => 0,
                ]);
            }
        }
        return Setting::all();
    }

    public function getSubscriptionList()
    {
        return Subscription::where('status', 1)->get();
    }
    public function packages()
    {
        return [
            'Theme',
            'Service',
            'Slider',
            'Portfolio',
            'Team',
            'Post',
        ];
    }

    public function getMenu()
    {
        if (!in_array('user_menu', json_decode(auth()->user()->permissions->permissions))) {
            return '';
        }
        if (!$this->checkModuleStatus('Theme')) {
            return '';
        }
        $view = view('theme::menu')->render();
        return $view;

    }
    public function menu()
    {
        $packages = $this->packages();
        $menu = '';
        foreach ($packages as $key => $package) {
            $files = collect(File::allFiles(base_path('packages/corporate/' . strtolower($package) . '/src/Facades/')))
                ->sortBy(function ($file) {
                    return $file->getBaseName();
                });
            if ($files) {
                $namesapce = "Corporate\\" . $package . "\Facades\\" . $package;
                $facadeName = $namesapce;
                if (method_exists($facadeName, 'getMenu')) {
                    $content = app($facadeName)->getMenu();
                    if ($content) {

                        $menu .= $content;
                    }
                }
            }
        }
        return $menu;
    }
    public function getPermissions()
    {

        return [
            'user_create',
            'user_edit',
            'user_delete',
            'user_menu',
            'user_view',
            'user_update',
            'setting',
            'dashboard',
            'subscription',
            'testimonial',
        ];
    }
    public function getPermission()
    {
        $packages = $this->packages();
        $permissions = [];
        foreach ($packages as $key => $package) {
            $files = collect(File::allFiles(base_path('packages/corporate/' . strtolower($package) . '/src/Facades/')))
                ->sortBy(function ($file) {
                    return $file->getBaseName();
                });
            if ($files) {
                $namesapce = "Corporate\\" . $package . "\Facades\\" . $package;
                $facadeName = $namesapce;
                if (method_exists($facadeName, 'getPermissions')) {
                    $content = app($facadeName)->getPermissions();
                    if ($content) {
                        $permissions[] = $content;
                    }
                }
            }
        }

        return $this->array_flatten($permissions);
    }

    public function array_flatten($permissions)
    {
        $per = [];
        foreach ($permissions as $key => $value) {
            foreach ($value as $k => $val) {
                $per[] = $val;
            }
        }
        return $per;
    }

    public function checkModuleStatus($moduleName)
    {
        $setting = Setting::where('module', $moduleName)->first();
        if ($setting) {
            return $setting->status;
        } else {
            Setting::create(['module' => $moduleName]);
            return 0;
        }

    }

    public function sendMail($to, $view, $subject, $data)
    {
        dispatch(new SendMailJob($to, $subject, $view, $data));

    }

    public function createSubscription(StoreSubscriptionRequest $request)
    {
        Subscription::create([
            'email' => $request->email,
            'status' => (!$request->status) ? 0 : 1,
        ]);
        return response()->json(['success' => 'Successfully Created']);
    }

}
