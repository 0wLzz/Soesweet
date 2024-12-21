<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('admin_table')}}">
            <img src="{{asset('img/logo_color.png')}}" alt="logo" style="height: 3em;">
            <span class="fw-bold" style="color: ">SoeSweet</span>
            <span>Admin Page</span>
        </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto d-flex justify-content-evenly w-100">
                <li class="nav-item"><a class="nav-link text-center fw-bold" href="{{route('admin_table')}}">Menu</a></li>
                <li class="nav-item"><a class="nav-link text-center fw-bold " href="{{route('testimony_homepage')}}">Testimonial</a></li>
                <li class="nav-item"><a class="nav-link text-center fw-bold " href="{{route('sales_homepage')}}">Product Sales</a></li>
            </ul>
        </div>

        <form action="{{route('logout_admin')}}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger mx-3">Logout</button>
        </form>
        <h2>Login: {{$admin->name}}</h2>

    </div>
</nav>
