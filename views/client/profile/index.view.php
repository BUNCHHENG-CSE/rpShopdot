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
    <div class="profile-container">
        <!-- Left Panel -->
        <div class="profile-sidebar">
            <div class="profile-avatar">
                <img id="profile-image-preview"
                    src="<?= $_SESSION['user']['image_path'] ?>"
                    alt="Profile Photo" />
            </div>
            <h2 class="profile-name"><?= $_SESSION['user']['name'] ?></h2>
            <p class="profile-username"><?= $_SESSION['user']['email'] ?></p>

            <!-- File input hidden by default -->
            <input type="file"
                id="profile-image-input"
                name="profile_image"
                accept="image/*"
                style="display:none;">

            <!-- Button to trigger file selection -->
            <button id="upload-photo-btn" class="btn upload-btn">
                Upload New Photo
            </button>

            <p class="member-since">Member Since:
                <?= date('d F Y', strtotime($_SESSION['user']['created_at'] ?? 'now')) ?>
            </p>

            <form action="/logout" method="POST" style="text-align: start;">
                <button type="submit" class="btn logout-btn">Logout</button>
            </form>
        </div>

        <div class="profile-content">
            <h2>Edit Profile</h2>

            <?php if (isset($_SESSION['profile_update_success'])): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($_SESSION['profile_update_success']) ?>
                    <?php unset($_SESSION['profile_update_success']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['errors'])): ?>
                <div class="alert alert-danger">
                    <?php foreach ($_SESSION['errors'] as $key => $error): ?>
                        <p><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                    <?php unset($_SESSION['errors']); ?>
                </div>
            <?php endif; ?>

            <ul class="profile-tabs">
                <li class="active">User Info</li>
            </ul>

            <div class="profile-form-section">
                <form id="profile-update-form" action="/profile/update" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="uploaded-image-url" name="uploaded_image_url">

                    <div class="profile-form-row">
                        <div class="profile-form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name"
                                value="<?= htmlspecialchars($_SESSION['user']['name']) ?>"
                                placeholder="Enter your full name" required />
                        </div>
                        <div class="profile-form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email"
                                value="<?= htmlspecialchars($_SESSION['user']['email']) ?>"
                                placeholder="Enter your email" required />
                        </div>
                    </div>

                    <div class="profile-form-row" style="width: 100%;">
                        <div class="profile-form-group">
                            <label for="old_password">Current Password <small>(leave blank if not changing)</small></label>
                            <input type="password" id="old_password" name="old_password"
                                placeholder="Enter current password" />
                        </div>
                    </div>

                    <div class="profile-form-row">
                        <div class="profile-form-group">
                            <label for="new_password">New Password <small>(min 8 characters)</small></label>
                            <input type="password" id="new_password" name="new_password"
                                placeholder="Enter new password" />
                        </div>
                        <div class="profile-form-group">
                            <label for="confirm_password">Confirm New Password</label>
                            <input type="password" id="confirm_password" name="confirm_password"
                                placeholder="Confirm new password" />
                        </div>
                    </div>

                    <div class="profile-form-row">
                        <button type="submit" class="btn update-btn">
                            Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include base_path('views/client/partials/newsletter.php') ?>
<?php include base_path('views/client/partials/footer.php') ?>