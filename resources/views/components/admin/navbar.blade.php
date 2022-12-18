<nav class="navbar">
    <div class="block">
        <ul class="navbar__links">
            <i class="far fa-times-circle navbar__close"></i>
            <li class="navbar__link">
                <a href="{{route('dashboard')}}" class="navbar__redirect">{{__('Dashboard')}}</a>
            </li>
            <li class="navbar__link">
                <a href="{{route('car')}}" class="navbar__redirect">{{__('Register Cars')}}</a>
            </li>
            <li class="navbar__link">
                <a href="{{route('userService')}}" class="navbar__redirect">{{__('Register Service')}}</a>
            </li>
            <li class="navbar__link">
                <a href="{{route('userServiceList')}}" class="navbar__redirect">{{__('List Services')}}</a>
            </li>
            <li class="navbar__link">
                <a href="{{route('logout')}}" class="navbar__redirect">{{__('Logout')}}</a>
            </li>
        </ul>
        <ul class="navbar__mobile">
            <li class="navbar__link">
                <i class="navbar__redirect fas fa-bars show"></i>
            </li>
        </ul>
    </div>
</nav>

<script defer="defer" src="{{asset('assets/js/custom/navbar.js')}}"></script>
