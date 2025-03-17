<?php

namespace Http\controller\client\profile;

use Core\Database;
use Core\Validator;
use Core\ValidationException;
use Core\Services\ImageUploadService;

class ProfileController
{
    protected $db;
    protected $imageUploadService;

    public function __construct(Database $db, ImageUploadService $imageUploadService)
    {
        $this->db = $db;
        $this->imageUploadService = $imageUploadService;
    }
    public function update($request)
    {
        $errors = [];
        $userId = $_SESSION['user']['id'];
        // dd($_SESSION['user']);
        // dd($_SESSION['user']['image_path']);
        // die();
        if (!Validator::string($request['name'], 2, 255)) {
            $errors['name'] = 'Name';
        }
        if (!Validator::email($request['email'])) {
            $errors['email'] = 'Invalid email address.';
        }
        $existingEmail = $this->db->query(
            "SELECT * FROM users WHERE email = ? AND user_id != ?",
            [$request['email'], $userId]
        )->find();

        if ($existingEmail) {
            $errors['email'] = 'This email is already in use.';
        }
        $imageUrl = $_SESSION['user']['image_path'];
        if (!empty($request['uploaded_image_url'])) {
            $imageUrl = $request['uploaded_image_url'];
        }
        $updatePassword = false;
        if (
            !empty($request['old_password']) ||
            !empty($request['new_password']) ||
            !empty($request['confirm_password'])
        ) {
            $user = $this->db->query("SELECT * FROM users WHERE user_id = ?", [$userId])->find();
            if (!password_verify($request['old_password'], $user['password'])) {
                $errors['old_password'] = 'Current password is incorrect.';
            }
            if (empty($request['new_password'])) {
                $errors['new_password'] = 'New password is required if changing password.';
            } elseif (!Validator::passwordlength($request['new_password'], 8)) {
                $errors['new_password'] = 'New password must be at least 8 characters.';
            }
            if ($request['new_password'] !== $request['confirm_password']) {
                $errors['confirm_password'] = 'New passwords do not match.';
            }

            $updatePassword = true;
        }
        if (!empty($errors)) {
            ValidationException::throw($errors, $request);
        }
        $query = "UPDATE users SET name = ?, email = ?, image_url = ?";
        $params = [$request['name'], $request['email'], $imageUrl];
        if ($updatePassword) {
            $query .= ", password = ?";
            $params[] = password_hash($request['new_password'], PASSWORD_BCRYPT);
        }
        $query .= " WHERE user_id = ?";
        $params[] = $userId;
        $this->db->query($query, $params);
        $_SESSION['user']['name'] = $request['name'];
        $_SESSION['user']['email'] = $request['email'];
        $_SESSION['user']['image_path'] = $imageUrl;

        $_SESSION['profile_update_success'] = 'Profile updated successfully!';
        redirect('/profile');
    }
}
