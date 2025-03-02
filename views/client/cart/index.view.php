<?php require base_path('views/client/partials/head.php') ?>
<?php require base_path('views/client/partials/nav.php') ?>

<section class="hero" id="hero">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="carousel-background">
                <img src="/../asset/images/slider7.png" alt="" style="object-fit: cover;">
                <div class="carousel-container">
                    <div class="carousel-content-container">
                        <h2>Product Details</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container my-5">
    <?php
    if (isset($_SESSION['cart_message'])) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">' .
            htmlspecialchars($_SESSION['cart_message']) .
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        unset($_SESSION['cart_message']);
    }
    ?>

    <div class="row">
        <div class="col-md-6">
            <img src="<?= htmlspecialchars($product['image_url']) ?>"
                alt="<?= htmlspecialchars($product['name']) ?>"
                class="img-fluid rounded">
        </div>
        <div class="col-md-6">
            <h1 class="mb-3"><?= htmlspecialchars($product['name']) ?></h1>
            <div class="mb-3">
                <span class="text-muted">Category: <?= htmlspecialchars($product['category_name']) ?></span>
            </div>
            <h2 class="text-primary mb-3">$<?= number_format($product['price'], 2) ?></h2>

            <div class="mb-3">
                <strong>Description:</strong>
                <p><?= htmlspecialchars($product['description']) ?></p>
            </div>

            <div class="mb-3">
                <strong>Stock:</strong>
                <span><?= $product['stock'] ?> units available</span>
            </div>

            <form action="/addcart/<?= $product['product_id'] ?>" method="GET">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input type="number"
                                class="form-control text-center"
                                value="1"
                                min="1"
                                max="<?= $product['stock'] ?>"
                                name="quantity">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-dark w-100">
                            Add to Cart
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require base_path('views/client/partials/footer.php') ?>