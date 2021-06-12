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
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ Theme::countTotalSubscriber() }}</h3>

                <p>Subscribers</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('subscriptions.index') }}" class="small-box-footer">More info <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>{{ Theme::countMenu() }}</h3>

                <p>Menu</p>
            </div>
            <div class="icon">
                <i class="ion ion-navicon"></i>
            </div>
            <a href="{{ route('menus.index') }}" class="small-box-footer">More info <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ Theme::countTestimonials() }}</h3>

                <p>Testimonials</p>
            </div>
            <div class="icon">
                <i class="ion ion-happy-outline"></i>
            </div>
            <a href="{{ route('testimonials.index') }}" class="small-box-footer">More info <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
