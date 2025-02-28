<?php require base_path('views/dashboard/partials/head.php') ?>
<?php require base_path('views/dashboard/partials/sidebar.php') ?>
<?php require base_path('views/dashboard/partials/nav.php') ?>
<div class="col-md-12 mb-lg-0 mb-4">
    <div class=" mt-4">
        <div class=" pb-0 p-3">
            <div class="row">
                <div class="col-3 d-flex align-items-center">
                    <h6 class="mb-0">Categories Tables</h6>
                </div>
                <div class="col-6 d-flex">
                    <div class="input-group">
                        <span class="input-group-text text-body"><i class="fas fa-search"
                                aria-hidden="true"></i></span>
                        <input type="text" class="form-control" placeholder="Type here...">
                    </div>
                </div>
                <div class="col-3 text-end">
                    <button type="button" class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" data-bs-target="#productModel" data-bs-whatever="@mdo"><i
                            class="fas fa-plus"></i>&nbsp;&nbsp;Create New Category</button>
                    <div class="modal fade" id="productModel" tabindex="-1" aria-labelledby="productModelLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="productModelLabel">New Products</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="POST">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="products-name" name="category-name" placeholder="Category Name">
                                        </div>
                                        <div class="mb-3">
                                            <textarea class="form-control" id="description-text" name="category-decription" placeholder="Category Description"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Name</th>
                                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Description</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-lg">MR-G</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class="text-md font-weight-bold mb-0 text-truncate" style="max-width: 250px;">A premium, full-metal G-SHOCK MR-G timepiece for diving — the titanium armor-clad, airtight MRG-BF1000 with ISO 200-meter water resistance — joins the FROGMAN family of full-fledged diver’s watches. A G-SHOCK diving watch carries the reliability of the G-SHOCK name to the depths, providing you with peace of mind that you have the best titanium diving watch.</p>
                                            </td>
                                            <td class="align-middle">
                                                <div class="ms-auto text-end">
                                                    <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i
                                                            class="fas fa-pencil-alt text-dark me-2 text-md" aria-hidden="true"></i>Edit</a>
                                                    <a class="btn btn-link text-danger text-gradient px-3 mb-0"
                                                        href="javascript:;"><i class="far fa-trash-alt me-2 text-md"></i>Delete</a>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require base_path('views/dashboard/partials/smallerfooter.php') ?>

<?php require base_path('views/dashboard/partials/footer.php') ?>
