<header class="main-header">

    <a href="{{ url('/home') }}" class="logo">
        <span class="logo-mini"><img src="{{asset('/img/logo_muserpol.png')}}" alt="Logo Muserpol" style="width: 30px;margin: 5px;"/></span>
        <span class="logo-lg">MUSERPOL</span>
    </a>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>


        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="hidden-xs">{!! Util::ucw(Auth::user()->first_name) !!} {!! Util::ucw(Auth::user()->last_name) !!} <span class="caret"></span></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li class="user-header">
                      <p>
                        {!! Util::ucw(Auth::user()->first_name) !!} {!! Util::ucw(Auth::user()->last_name) !!}
                        <small>{!! Auth::user()->role->name !!}</small>
                      </p>
                    </li>
                    </li>
                    <li class="user-footer">
                      <div class="pull-left">
                        <a href="{!! url('user/' . Auth::user()->id . '/edit') !!}" class="btn btn-raised btn-info">Perfil</a>
                      </div>
                      <div class="pull-right">
                        <a href="{!! url('logout') !!}" class="btn btn-raised btn-danger">Salir</a>
                      </div>
                    </li>
                  </ul>
                </li>
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-cog"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
