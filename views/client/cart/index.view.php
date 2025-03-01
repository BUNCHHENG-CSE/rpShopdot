<?php require base_path('views/client/partials/head.php') ?>
<?php require base_path('views/client/partials/nav.php') ?>

<section class="hero" id="hero">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="carousel-background">
                    <img src="asset/images/img_bg_2.jpg" alt="" style="object-fit: cover;">
                    <div class="carousel-container">
                        <div class="carousel-content-container">
                            <h2>Cart</h2>
                        </div>
                    </div>


                </div>
            </div>

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
<div class="site-section">
    <section class="" style="width: 100%;">
        <table class="table table-bordered ">
            <thead>
                <tr>
                    <th class="text-center" style="width: 6.25rem;"></th>
                    <th class="text-center" style="width: 9.375rem;">Image</th>
                    <th class="text-center" style="width: 12.5rem;">Product</th>
                    <th class="text-center" style="width: 6.25rem;">Price</th>
                    <th class="text-center" style="width: 6.25rem;">Quantity</th>
                    <th class="text-center" style="width: 6.25rem;">Subtotal</th>
                </tr>
            </thead>
            <tbody id="cart-products-display">

            </tbody>
        </table>
    </section>
</div>

<section class="d-flex flex-wrap justify-content-between p-3">

    <div class="mb-4 border p-3" style="width: 80%;">
        <h3 class="mb-3">Cart Totals</h3>
        <table class="table">
            <tbody>
                <tr>
                    <td>Cart Subtotal</td>
                    <td id="cart-subtotal">$0.00</td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>Free</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong id="cart-total">$0.00</strong></td>
                </tr>
            </tbody>
        </table>
        <div class="form-group">
            <div id="paypal-button-container"></div>
        </div>
    </div>
</section>

<section id="fh5co-started">
    <div class="container">
        <div class="row"
            style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
            <div class="col-md-8 col-md-offset-2 fh5co-heading" style="text-align: center;">
                <h2>Newsletter</h2>
                <p>Just stay tuned for our latest product. Now you can subscribe.</p>
            </div>
        </div>
        <div class="row" style="display: flex; justify-content: center; align-items: center;">
            <div class="col-md-8 col-md-offset-2">
                <form class="form-inline"
                    style="display: flex; justify-content: center; align-items: center; width: 100%;">
                    <div class="col-md-6 col-sm-6">
                        <div style="display: flex; justify-content: center;">

                            <input type="email" class="form-control" style="width: 90%; height: 54px;" id="email"
                                placeholder="Email">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6" style="display: flex; justify-content: center;">
                        <button type="submit" class="btn ">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>
<?php require base_path('views/client/partials/footer.php') ?>
