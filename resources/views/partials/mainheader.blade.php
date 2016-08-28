<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/home') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img src="{{asset('/img/logo_muserpol.png')}}" alt="Logo Muserpol" style="width: 30px;margin: 5px;"/></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">MUSERPOL</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <div class="col-md-10">
                {!! Form::open(['url' => 'search_affiliate', 'role' => 'form', 'class' => 'navbar-form navbar-left']) !!}
            			<div class="form-group">
            				<div class="col-md-12" data-toggle="tooltip" data-placement="bottom" data-original-title="Ingrese el número de Carnet del Afiliado">
              					<input type="text" class="form-control" name="identity_card" size="10" style="font-size:20px" onkeyup = "this.value=this.value.toUpperCase()">
              				</div>
            			</div>
	          			{!! Form::close() !!}
            </div>
            <ul class="nav navbar-nav">
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
