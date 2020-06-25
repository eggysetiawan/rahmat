<!--Main Navigation-->
<header>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
        <div class="container">

            <!-- Brand -->
            <a class="navbar-brand waves-effect" href="index.php">
                <img src="image/ipi.png" height="50" class="d-inline-block align-top animated jackInTheBox slow">
            </a>

            <!-- Collapse -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Links -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <!-- Left -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link waves-effect" href="#">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link waves-effect" href="#product">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link waves-effect" href="#populasi">Free PACS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link waves-effect" href="#about">About</a>
                    </li>
                </ul>

                <!-- Right -->
                <ul class="navbar-nav nav-flex-icons">

                    <li class="nav-item">
                        <a href="login.php" class="nav-link border border-light rounded waves-effect">
                            <i class="fas fa-user mr-2"></i>Login
                        </a>
                    </li>
                </ul>

            </div>

        </div>
    </nav>
    <!-- Navbar -->

</header>
<!--Main Navigation-->


<script src="jquery-3.2.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('ul li').click(function() {
            $('li').removeClass("active");
            $(this).addClass("active");
        });
    });
</script>