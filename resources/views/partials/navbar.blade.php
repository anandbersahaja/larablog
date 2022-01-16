<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="box-shadow: 0 .15rem .6rem rgba(0,0,0, .3);">
    <div class="container">
        <a class="navbar-brand" href="/">Bersahaja</a>
        
        
            
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        
        
        <div class="collapse navbar-collapse" id="navbarNav">
          
        <ul class="navbar-nav gap-3 ">
          
          <li class="nav-item">
              <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Home</a>
          </li>
          <li class="nav-item">
              <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="/about">About</a>
          </li>
          <li class="nav-item">
              <a class="nav-link {{ request()->is('blog') ? 'active' : '' }}" href="/blog">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('categories') ? 'active' : '' }}" href="/categories">Category</a>
          </li>
        </ul>

        <ul class="navbar-nav ms-auto">
          @auth
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                {{ auth()->user()->name }}
              </a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-sidebar"></i> My Dashboard</a></li>
                <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-person"></i> Account</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
                  </form>
                </li>
              </ul>
            </li>
          
          @else
            <li class="nav-item">
              <a href="/login" class="nav-link {{ $active === 'login' ? 'active': '' }}" role="button" id="dropdownMenuLink
              data-bs-toggle="dropdown" >Login <i class="bi bi-box-arrow-in-right"></i></a>
            </li>
          @endauth
          
        </ul>
            
        </div>
    </div>
</nav>