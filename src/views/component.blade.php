@if(auth()->user()->hasRole('superadmin')||auth()->user()->hasRole('admin'))
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
        <div class="inner">
            <h3>{{ Theme::countTotalUser() }}</h3>

            <p>Total Users</p>
        </div>
        <div class="icon">
            <i class="ion ion-person-stalker"></i>
        </div>
        <a href="{{ route('users.index') }}" class="small-box-footer">More info <i
                class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

@endif