<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <a class="navbar-brand" href="/">{{config('app.name','LSAPP')}}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav navbar-right">
            <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/about">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/services">Services</a>
            </li> 
            <li class="nav-item">
                <a class="nav-link" href="/posts">Blog</a>
            </li>    
        </ul>
        <ul class="navbar-nav ml-auto">
            <li><a href="/posts/create" class="btn btn-md btn-primary">Create New</a></li>
        </ul>
    </div>
    
</nav>
