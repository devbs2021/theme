<li class="nav-item">
    <a href="{{ route('dashboard') }}" class="nav-link {{ (\Route::currentRouteName()=='dashboard')?'active':'' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Dashboard
            {{-- <i class="fas fa-angle-left right"></i> --}}
            {{-- <span class="badge badge-info right">6</span> --}}
        </p>
    </a>
</li>
{!! Theme::menu() !!}

@if (auth()->user()->can('page_menu'))
<li class="nav-item cms-menu">
    <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-bolt"></i>
        <p>
            Pages
            <i class="fas fa-angle-left right"></i>
            {{-- <span class="badge badge-info right">6</span> --}}
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('cms.create') }}"
                class="nav-link {{ \Route::currentRouteName()=='cms.create'?'active':'' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>Create Page</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('cms.index') }}"
                class="nav-link {{ \Route::currentRouteName()=='cms.index'?'active':'' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>List Pages</p>
            </a>
        </li>
    </ul>
</li>
@endif



@if (auth()->user()->can('testimonial_menu'))
<li class="nav-item testimonial-menu">
    <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-quote-left"></i>
        <p>
            Testimonial
            <i class="fas fa-angle-left right"></i>
            {{-- <span class="badge badge-info right">6</span> --}}
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('testimonials.create') }}"
                class="nav-link {{ \Route::currentRouteName()=='testimonials.create'?'active':'' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>Create Testimonial</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('testimonials.index') }}"
                class="nav-link {{ \Route::currentRouteName()=='testimonials.index'?'active':'' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>List Testimonials</p>
            </a>
        </li>
    </ul>
</li>
@endif
@if (auth()->user()->can('faq_menu'))
<li class="nav-item faq-menu">
    <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-question"></i>
        <p>
            Faq
            <i class="fas fa-angle-left right"></i>
            {{-- <span class="badge badge-info right">6</span> --}}
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('faqs.create') }}"
                class="nav-link {{ \Route::currentRouteName()=='faqs.create'?'active':'' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>Create Faq</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('faqs.index') }}"
                class="nav-link {{ \Route::currentRouteName()=='faqs.index'?'active':'' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>List Faq</p>
            </a>
        </li>
    </ul>
</li>
@endif

@if (auth()->user()->can('menu_menu'))
<li class="nav-item menu-menu">
    <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-bars"></i>
        <p>
            Menu
            <i class="fas fa-angle-left right"></i>
            {{-- <span class="badge badge-info right">6</span> --}}
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('menus.create') }}"
                class="nav-link {{ \Route::currentRouteName()=='menus.create'?'active':'' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>Create Menu</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('menus.index') }}"
                class="nav-link {{ \Route::currentRouteName()=='menus.index'?'active':'' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>List Menu</p>
            </a>
        </li>
    </ul>
</li>
@endif
@if (auth()->user()->can('subscription_menu'))
<li class="nav-item subscription-menu">
    <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-user-plus"></i>
        <p>
            Subscription
            <i class="fas fa-angle-left right"></i>
            {{-- <span class="badge badge-info right">6</span> --}}
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('subscriptions.create') }}"
                class="nav-link {{ \Route::currentRouteName()=='subscriptions.create'?'active':'' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>Create Subscription</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('subscriptions.index') }}"
                class="nav-link {{ \Route::currentRouteName()=='subscriptions.index'?'active':'' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>List Subscriptions</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('mail') }}" class="nav-link {{ \Route::currentRouteName()=='mail'?'active':'' }}">
                <i class="nav-icon fas fa-envelope"></i>
                <p>Send Mail</p>
            </a>
        </li>
    </ul>
</li>
@endif

@if (auth()->user()->can('message_menu'))
<li class="nav-item message-menu">
    <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-envelope"></i>
        <p>
            Messsage
            <i class="fas fa-angle-left right"></i>
            {{-- <span class="badge badge-info right">6</span> --}}
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('messages.index') }}"
                class="nav-link {{ \Route::currentRouteName()=='messages.index'?'active':'' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>List Messages</p>
            </a>
        </li>
    </ul>
</li>
@endif
@if (auth()->user()->can('user_menu'))
<li class="nav-item user-menu">
    <a href="#" class="nav-link ">
        <i class="nav-icon fa fa-user"></i>
        <p>
            User Management
            <i class="fas fa-angle-left right"></i>
            {{-- <span class="badge badge-info right">6</span> --}}
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('roles.create') }}"
                class="nav-link {{ \Route::currentRouteName()=='roles.create'?'active':'' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>Create Role</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('roles.index') }}"
                class="nav-link {{ \Route::currentRouteName()=='roles.index'?'active':'' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>List Role</p>
            </a>
        </li>
    </ul>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('users.create') }}"
                class="nav-link {{ \Route::currentRouteName()=='users.create'?'active':'' }}">
                <i class="nav-icon fas fa-edit"></i>
                <p>Create user</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('users.index') }}"
                class="nav-link {{ \Route::currentRouteName()=='users.index'?'active':'' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>List Users</p>
            </a>
        </li>
    </ul>
</li>
@endif
@if (auth()->user()->can('company_profile'))
<li class="nav-item">
    <a href="{{ route('sites.index') }}" class="nav-link {{ (\Route::currentRouteName()=='sites.index')?'active':'' }}">
        <i class="nav-icon fas fa-cog"></i>
        <p>
            Company Profile
            {{-- <i class="fas fa-angle-left right"></i> --}}
            {{-- <span class="badge badge-info right">6</span> --}}
        </p>
    </a>
</li>
@endif

@if (auth()->user()->can('css'))
<li class="nav-item">
    <a href="{{ route('css.index') }}" class="nav-link {{ (\Route::currentRouteName()=='css.index')?'active':'' }}">
        <i class="nav-icon fab fa-css3-alt"></i>
        <p>
            Css

            {{-- <span class="badge badge-info right">6</span> --}}
        </p>
    </a>
</li>
@endif
@if (auth()->user()->can('config'))
<li class="nav-item">
    <a href="{{ route('config.index') }}"
        class="nav-link {{ (\Route::currentRouteName()=='config.index')?'active':'' }}">
        <i class="nav-icon fas fa-skull"></i>
        <p>
            Config

            {{-- <span class="badge badge-info right">6</span> --}}
        </p>
    </a>
</li>
@endif