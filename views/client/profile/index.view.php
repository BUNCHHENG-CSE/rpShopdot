<?php include base_path('views/client/partials/head.php') ?>
<?php include base_path('views/client/partials/nav.php') ?>


<section class="hero" id="hero">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="carousel-background">
                    <img src="asset/images/slider6.png" alt="" style="object-fit: cover;">
                    <div class="carousel-container">
                        <div class="carousel-content-container">
                            <h2>Profile</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <form action="/logout" method="POST">
        <button
            type="submit"
            class="btn nav-link btnLogin">
            logout
        </button>
    </form>
    </div>
</section>
<?php require base_path('views/client/partials/footer.php') ?>