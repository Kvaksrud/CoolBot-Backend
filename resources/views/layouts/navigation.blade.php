<nav class="py-2 bg-light border-bottom">
    <div class="container d-flex flex-wrap">
        <ul class="nav me-auto">
            <li class="nav-item"><a href="{{route('dashboard')}}" class="nav-link link-dark px-2 @if(request()->routeIs('dashboard')) active @endif " aria-current="page">Home</a></li>
            <li class="nav-item"><a href="{{route('user.tokens')}}" class="nav-link link-dark px-2 @if(request()->routeIs('user.tokens')) active @endif " aria-current="page">User Tokens</a></li>
            <li class="nav-item"><a href="{{route('BankAccount.index')}}" class="nav-link link-dark px-2 @if(request()->routeIs('BankAccount.index')) active @endif " aria-current="page">Bank Account</a></li>
            <li class="nav-item"><a href="{{route('LaborReply.index')}}" class="nav-link link-dark px-2 @if(request()->routeIs('LaborReply.index')) active @endif " aria-current="page">Labor Replies</a></li>
            <li class="nav-item"><a href="{{route('Option.index')}}" class="nav-link link-dark px-2 @if(request()->routeIs('Option.index')) active @endif " aria-current="page">Options</a></li>
                    </ul>
        <ul class="nav">
            @auth()
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{route('logout')}}" onclick="event.preventDefault(); this.closest('form').submit();" class="nav-link link-dark px-2">Logout</a>
                    </form>
                </li>
            @elseauth()
                <li class="nav-item"><a href="{{route('login')}}" class="nav-link link-dark px-2">Log in</a></li>
            @endauth
        </ul>
    </div>
</nav>
