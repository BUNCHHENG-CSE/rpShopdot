document.addEventListener("DOMContentLoaded", function () {
  const profileImageInput = document.getElementById("profile-image-input");
  const profileImagePreview = document.getElementById("profile-image-preview");
  const uploadPhotoBtn = document.getElementById("upload-photo-btn");
  const uploadedImageUrlInput = document.getElementById("uploaded-image-url");
  const originalImageSrc = profileImagePreview.src;

  function previewImage(input) {
    const file = input.files[0];
    const reader = new FileReader();

    reader.onloadend = function () {
      profileImagePreview.src = reader.result;
    };

    if (file) {
      reader.readAsDataURL(file);
    } else {
      profileImagePreview.src = originalImageSrc;
    }
  }

  function validateFile(file) {
    const maxFileSize = 5 * 1024 * 1024;
    const allowedTypes = ["image/jpeg", "image/png", "image/webp"];

    if (file.size > maxFileSize) {
      alert("File size must be less than 5MB");
      return false;
    }

    if (!allowedTypes.includes(file.type)) {
      alert("Please upload a valid image (JPEG, PNG, or WebP)");
      return false;
    }

    return true;
  }

  function uploadImage(file) {
    const formData = new FormData();
    formData.append("profile_image", file);

    fetch("/profile/upload-image", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          uploadedImageUrlInput.value = data.image_url;
          alert(
            'Image uploaded successfully. Click "Update Profile" to save changes.'
          );
        } else {
          alert("Image upload failed: " + data.message);
          profileImagePreview.src = originalImageSrc;
        }
      })
      .catch((error) => {
        console.error("Upload error:", error);
        alert("An error occurred during upload");
        profileImagePreview.src = originalImageSrc;
      });
  }

  profileImageInput.addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
      if (validateFile(file)) {
        previewImage(this);
        uploadImage(file);
      } else {
        event.target.value = "";
      }
    }
  });

  uploadPhotoBtn.addEventListener("click", function () {
    profileImageInput.click();
  });
});
