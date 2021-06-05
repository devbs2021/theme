<li class="nav-item">
    <a href="{{ route('dashboard') }}" class="nav-link {{ (\Route::currentRouteName()=='dashboard')?'active':'' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Dashboard
            <i class="fas fa-angle-left right"></i>
            {{-- <span class="badge badge-info right">6</span> --}}
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('settings.index') }}"
        class="nav-link {{ (\Route::currentRouteName()=='settings.index')?'active':'' }}">
        <i class="nav-icon fas fa-cog"></i>
        <p>
            Setting
            <i class="fas fa-angle-left right"></i>
            {{-- <span class="badge badge-info right">6</span> --}}
        </p>
    </a>
</li>
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
@if(in_array('testimonial', json_decode(auth()->user()->permissions->permissions)))
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
@if(in_array('subscription', json_decode(auth()->user()->permissions->permissions)))
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
            <a href="{{ route('mail') }}"
                class="nav-link {{ \Route::currentRouteName()=='mail'?'active':'' }}">
                <i class="nav-icon fas fa-envelope"></i>
                <p>Send Mail</p>
            </a>
        </li>
    </ul>
</li>
@endif