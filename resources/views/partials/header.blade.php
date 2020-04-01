<header class="header">
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid d-flex align-items-center justify-content-between">
        <div class="navbar-header">
          <!-- Navbar Header--><a href="{{ route('dashboard') }}" class="navbar-brand">
            <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">Expense Manager</strong></div>
            <div class="brand-text brand-sm"><strong class="text-primary">EM</strong></div></a>
          <!-- Sidebar Toggle Btn-->
          <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
        </div>
        <div class="right-menu list-inline no-margin-bottom">
          <div class="list-inline-item">
            Welcome to Expense Manager
          </div>
          <!-- Log out -->
          <div class="list-inline-item logout">
            <a id="logout" href="/logout" class="nav-link"><span class="d-none d-sm-inline">Logout </span><i class="icon-logout"></i></a>
          </div>
        </div>
      </div>
    </nav>
</header>