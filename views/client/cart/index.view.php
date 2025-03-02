<?php require base_path('views/client/partials/head.php') ?>
<?php require base_path('views/client/partials/nav.php') ?>
<?php $totalPrice = 0; ?>
<section class="hero" id="hero">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="carousel-background">
                <img src="/../asset/images/slider5.png" alt="" style="object-fit: cover;">
                <div class="carousel-container">
                    <div class="carousel-content-container">
                        <h2>Cart</h2>
                    </div>
                </div>
            </div>
        </div>
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
                <?php if ($_SESSION['cart'] ?? false) : ?>
                    <?php foreach ($_SESSION['cart'] as $item) : ?>
                        <tr>
                            <td class="text-center">
                                <form action="/removecart" method="POST" onsubmit="return confirm('Are you sure you want to remove this item?');">
                                    <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <span>&times;</span>
                                    </button>
                                </form>
                            </td>
                            <td class="text-center">
                                <img src="<?= $item['image'] ?>" alt="<?= $item['name'] ?>" class="img-fluid" style="max-width: 50px;">
                            </td>
                            <td class="text-center"><?= $item['name'] ?></td>
                            <td class="text-center">$<?= $item['price'] ?></td>
                            <td class="text-center">
                                <div class="d-flex align-items-center justify-content-center">
                                    <button type="submit" name="action" value="decrease" class="btn btn-sm btn-outline-secondary me-2">-</button>
                                    <input type="text"
                                        name="quantity"
                                        class="form-control text-center"
                                        value="<?= $item['quantity'] ?>"
                                        style="width: 60px;"
                                        min="1"
                                        max="<?= $item['max_stock'] ?>">
                                    <button type="submit" name="action" value="increase" class="btn btn-sm btn-outline-secondary ms-2">+</button>
                                </div>
                            </td>
                            <?php $totalPrice = $totalPrice + ($item['price'] * $item['quantity']); ?>
                            <td class="text-center">$<?= $item['price'] * $item['quantity']   ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Your cart is empty</td>
                    </tr>
                <?php endif; ?>
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
                    <td id="cart-subtotal">$<?= $totalPrice ?></td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>Free</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong id="cart-total">$<?= $totalPrice ?></strong></td>
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