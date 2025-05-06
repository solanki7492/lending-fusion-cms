<header class="header header-sticky p-0 mb-4">
        <div class="container-fluid border-bottom px-4">
          <button class="header-toggler" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()" style="margin-inline-start: -14px;">
            <svg class="icon icon-lg">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
            </svg>
          </button>
          
          <ul class="header-nav">
            <li class="nav-item dropdown"><a class="nav-link py-0 pe-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-md"><img class="avatar-img" src="https://coreui.io/demos/bootstrap/5.1/free/assets/img/avatars/8.jpg" alt="user@email.com"></div>
              </a>
              <div class="dropdown-menu dropdown-menu-end pt-0">
                
            <form action="{{ route('logout') }}" method="POST" class="p-2" style="margin: 0;">
                @csrf
                <button type="submit" class="dropdown-item btn btn-link" style="color: inherit; text-align: left; padding: 0; border: none; background: none;">
                    Logout
                </button>
            </form>
            </li>
          </ul>
        </div>
       
      </header>