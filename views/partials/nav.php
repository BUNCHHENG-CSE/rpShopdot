<header>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/"
                style="font-size: 1.5rem; text-transform: uppercase; font-weight: 600;">Shop.</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <i class="navbar-icon bi-filter-right"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= urlIs('/') ? "active" : ""?> " aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= urlIs('/products') ?  "active" : "" ?>" aria-current="page" href="/products">Product</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= urlIs('/about') ?  "active" : "" ?>" aria-current="page" href="/about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= urlIs('/contact') ?  "active" : "" ?>" aria-current="page" href="/contact">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link cart <?= urlIs('/cart') ?  "active" : "" ?>" aria-current="page" href="/cart"> <span><small id="productamount">0</small><i
                                    class="bi bi-cart-fill" style="font-size: 19px;"></i></span></a>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link btn" >Login</button>
                    </li>
                    <!-- <li class="nav-item">
                            <button class="nav-link" style="border: none;">Logout</button>
                        </li> -->
                </ul>

            </div>
        </div>
    </nav>
</header>
