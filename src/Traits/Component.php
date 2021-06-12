<?php
namespace DevbShrestha\Theme\Traits;

use App\Models\User;
use DevbShrestha\Theme\Models\Menu;
use DevbShrestha\Theme\Models\Subscription;
use DevbShrestha\Theme\Models\Testimonial;
trait Component
{

    public function countTotalUser()
    {
        return count(User::all());
    }
    public function countTotalSubscriber()
    {
        return count(Subscription::all());
    }
    public function countMenu()
    {
        return count(Menu::all());
    }

    public function countTestimonials()
    {
        return count(Testimonial::all());
    }

}
