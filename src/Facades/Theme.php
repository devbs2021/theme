<?php

namespace DevbShrestha\Theme\Facades;

use DevbShrestha\Theme\Jobs\SendMailJob;
use DevbShrestha\Theme\Models\CMS;
use DevbShrestha\Theme\Models\Menu;
use DevbShrestha\Theme\Models\Setting;
use DevbShrestha\Theme\Models\Site;
use DevbShrestha\Theme\Models\Subscription;
use DevbShrestha\Theme\Models\Testimonial;
use DevbShrestha\Theme\Requests\StoreSubscriptionRequest;
use DevbShrestha\Theme\Traits\Component;
use File;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Theme
{
    use Component;

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

        return config('theme.packages');
    }

    public function menuTheme()
    {

        $view = view('theme::menu')->render();
        return $view;

    }
    public function menu()
    {
        $packages = $this->packages();
        $menu = '';
        foreach ($packages as $key => $package) {
            $files = collect(File::allFiles(base_path('vendor/devbshrestha/' . strtolower($package) . '/src/Facades/')))
                ->sortBy(function ($file) {
                    return $file->getBaseName();
                });
            if ($files) {
                $namesapce = "DevbShrestha\\" . $package . "\Facades\\" . $package;
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
    public function component()
    {
        $packages = $this->packages();
        $component = '';
        foreach ($packages as $key => $package) {
            $files = collect(File::allFiles(base_path('vendor/devbshrestha/' . strtolower($package) . '/src/Facades/')))
                ->sortBy(function ($file) {
                    return $file->getBaseName();
                });
            if ($files) {
                $namesapce = "DevbShrestha\\" . $package . "\Facades\\" . $package;
                $facadeName = $namesapce;
                if (method_exists($facadeName, 'getComponent')) {
                    $content = app($facadeName)->getComponent();
                    if ($content) {

                        $component .= $content;
                    }
                }
            }
        }
        return $component;
    }
    public function renderPackageMenu()
    {

    }

    public function getComponent()
    {

        return view('theme::component');
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
            'role_create',
            'role_edit',
            'role_delete',
            'role_menu',
            'role_view',
            'role_update',
            'testimonial_create',
            'testimonial_edit',
            'testimonial_delete',
            'testimonial_menu',
            'testimonial_view',
            'testimonial_update',
            'page_create',
            'page_edit',
            'page_delete',
            'page_menu',
            'page_view',
            'page_update',
            'subscription_create',
            'subscription_edit',
            'subscription_delete',
            'subscription_menu',
            'subscription_view',
            'subscription_update',
            'menu_create',
            'menu_edit',
            'menu_delete',
            'menu_menu',
            'menu_view',
            'menu_update',
            'site_setting',
            'company_profile',
        ];
    }
    public function getPermission()
    {
        $packages = $this->packages();
        $permissions = [];
        foreach ($packages as $key => $package) {
            $files = collect(File::allFiles(base_path('vendor/devbshrestha/' . strtolower($package) . '/src/Facades/')))
                ->sortBy(function ($file) {
                    return $file->getBaseName();
                });
            if ($files) {
                $namesapce = "DevbShrestha\\" . $package . "\Facades\\" . $package;
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
                $this->createPermisstion($val);
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

    public function getMenus()
    {
        return Menu::all();
    }

    public function siteSetup()
    {
        $site = Site::first();
        if (!$site) {
            $site = Site::create([
                'name' => 'default',
                'logo' => 'default',
                'email' => 'default@default.com',
                'favicon' => 'default',
                'phone' => 'default',
                'address' => 'default',
                'introduction' => 'default',
            ]);
        }
        return $site;
    }

    public function testimonials()
    {
        return Testimonial::where('status', 1)->orderBy('position', 'ASC')->get();
    }

    public function getCMSBySlug($slug)
    {
        return CMS::where('slug', $slug)->where('status', 1)->first();
    }

    public function getHeaderMenu()
    {
        return Menu::where('type', 'HEADER')->with('page')->where('status', 1)->with('menus', function ($query) {
            return $query->where('status', 1)->orderBy('position', 'ASC');
        })->orderBy('position', 'ASC')->get();
    }
    public function getFooterMenu()
    {
        return Menu::where('type', 'FOOTER')->with('page')->where('status', 1)->with('menus', function ($query) {
            return $query->where('status', 1)->orderBy('position', 'ASC');

        })->orderBy('position', 'ASC')->get();
    }

    public function getPermissionListByPackage($package)
    {
        $contents = [];
        $namesapce = "Corporate\\" . $package . "\Facades\\" . $package;
        $facadeName = $namesapce;
        if (method_exists($facadeName, 'getPermissions')) {
            $content = app($facadeName)->getPermissions();
            if ($content) {
                $contents = $content;
            }
        }
        return $contents;
    }

    public function createPermisstion($name)
    {

        $check = Permission::where('name', $name)->first();
        if (!$check) {

            Permission::create(['name' => $name]);
        }

    }
    public function getRoles()
    {
        return Role::all();
    }

    public function getPage()
    {
        return CMS::all();
    }

}
