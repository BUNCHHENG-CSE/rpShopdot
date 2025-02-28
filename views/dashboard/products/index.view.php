<?php require base_path('views/dashboard/partials/head.php') ?>
<?php require base_path('views/dashboard/partials/sidebar.php') ?>
<?php require base_path('views/dashboard/partials/nav.php') ?>
<?php
 dd($products);
?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_SESSION['message']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <?php unset($_SESSION['message']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_SESSION['error']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <?php unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Products Management</h6>
                    <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#createProductModal">
                        <i class="fas fa-plus me-2"></i>Add New Product
                    </button>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Category</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stock</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($products)): ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <p class="text-xs text-secondary mb-0">No products found</p>
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($products as $product): ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="<?= htmlspecialchars($product['image_url'] ?? 'asset/images/default-product.png') ?>" 
                                                             class="avatar avatar-sm me-3" 
                                                             alt="<?= htmlspecialchars($product['name']) ?>">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm"><?= htmlspecialchars($product['name']) ?></h6>
                                                        <p class="text-xs text-secondary mb-0">
                                                            <?= htmlspecialchars(substr($product['description'] ?? '', 0, 50)) . 
                                                                (strlen($product['description'] ?? '') > 50 ? '...' : '') ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    <?= htmlspecialchars($product['category_id'] ?? 'Uncategorized') ?>
                                                </p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    $<?= number_format($product['price'], 2) ?>
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="badge bg-gradient-<?= $product['stock'] > 10 ? 'success' : 'warning' ?> text-white">
                                                    <?= intval($product['stock']) ?>
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex justify-content-center">
                                                    <a href="/products/edit/<?= $product['product_id'] ?>" 
                                                       class="btn btn-link text-dark px-2 mb-0" 
                                                       data-bs-toggle="tooltip" 
                                                       data-bs-placement="top" 
                                                       title="Edit Product">
                                                        <i class="fas fa-edit text-primary"></i>
                                                    </a>
                                                    <a href="/products/delete/<?= $product['product_id'] ?>" 
                                                       class="btn btn-link text-danger px-2 mb-0" 
                                                       data-bs-toggle="tooltip" 
                                                       data-bs-placement="top" 
                                                       title="Delete Product"
                                                       onclick="return confirm('Are you sure you want to delete this product?');">
                                                        <i class="fas fa-trash-alt text-danger"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Product Modal -->
<div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="createProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createProductModalLabel">Create New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/products/create" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="product-name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="product-name" name="name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="product-category" class="form-label">Category</label>
                            <select class="form-select" id="product-category" name="category_id" required>
                                <option value="">Select Category</option>
                                <option value="1">Electronics</option>
                                <option value="2">Clothing</option>
                                <option value="3">Accessories</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="product-price" class="form-label">Price</label>
                            <input type="number" step="0.01" class="form-control" id="product-price" name="price" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="product-stock" class="form-label">Stock Quantity</label>
                            <input type="number" class="form-control" id="product-stock" name="stock" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="product-description" class="form-label">Description</label>
                        <textarea class="form-control" id="product-description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="product-image" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="product-image" name="image" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require base_path('views/dashboard/partials/smallerfooter.php') ?>
<?php require base_path('views/dashboard/partials/footer.php') ?>