<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="{{ url('/home') }}">Dashboard<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" target="_blank" href="{{ url('/') }}">Trang chủ <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('slider.index') }}">Slider</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('category.index') }}">Danh mục game</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('blog.index') }}">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('video.index') }}">Video</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Dịch vụ game</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Nick game</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Disabled</a>
        </li>
      </ul>
    </div>
</nav>