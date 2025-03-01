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
                        <a class="nav-link <?= urlIs('/') ? "active" : "" ?> " aria-current="page" href="/">Home</a>
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
                        <button  type="button" class="btn nav-link btnLogin" data-bs-toggle="modal" data-bs-target="#loginModel" data-bs-whatever="@mdo"><i
                                class="fas fa-plus"></i>&nbsp;&nbsp;Login</button>
                        <div class="modal fade" id="loginModel" tabindex="-1" aria-labelledby="loginModelLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="loginModelLabel" >Login</h1>
                                        <button type="button" class="btn-close btnFormClose" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POST">
                                            <div class="mb-3">
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                                            </div>
                                            <div class="mb-3">
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Login</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- <li class="nav-item">
                            <button class="nav-link" style="border: none;">Logout</button>
                        </li> -->
                </ul>

            </div>
        </div>
    </nav>
</header>
