document.addEventListener("DOMContentLoaded", function () {
  const productQuantityManagement = () => {
    const minusBtn = document.getElementById("minus-btn");
    const plusBtn = document.getElementById("plus-btn");
    const quantityInput = document.getElementById("quantity");
    const addToCartBtn = document.getElementById("add-to-cart-btn");

    if (!minusBtn || !plusBtn || !quantityInput || !addToCartBtn) return;

    const maxStock = parseInt(quantityInput.getAttribute("max") || 10);
    minusBtn.addEventListener("click", function () {
      let currentValue = parseInt(quantityInput.value);
      if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
        updateAddToCartLink();
      }
    });
    plusBtn.addEventListener("click", function () {
      let currentValue = parseInt(quantityInput.value);
      if (currentValue < maxStock) {
        quantityInput.value = currentValue + 1;
        updateAddToCartLink();
      }
    });
    quantityInput.addEventListener("input", function () {
      let value = parseInt(this.value);
      if (isNaN(value) || value < 1) {
        this.value = 1;
      } else if (value > maxStock) {
        this.value = maxStock;
      }
      updateAddToCartLink();
    });

    function updateAddToCartLink() {
      const productId = addToCartBtn.getAttribute("data-product-id");
      addToCartBtn.href = `/addcart/${productId}?quantity=${quantityInput.value}`;
    }
  };
  const cartQuantityManagement = () => {
    const quantityForms = document.querySelectorAll(".cart-quantity-form");

    quantityForms.forEach((form) => {
      const minusBtn = form.querySelector(".btn-minus");
      const plusBtn = form.querySelector(".btn-plus");
      const quantityInput = form.querySelector(".cart-quantity-input");
      const productId = form.querySelector('input[name="product_id"]').value;
      const maxStock = parseInt(quantityInput.getAttribute("max") || 10);

      minusBtn.addEventListener("click", function (e) {
        e.preventDefault();
        updateQuantity(productId, -1);
      });

      plusBtn.addEventListener("click", function (e) {
        e.preventDefault();
        updateQuantity(productId, 1);
      });

      quantityInput.addEventListener("change", function (e) {
        let value = parseInt(this.value);
        if (isNaN(value) || value < 1) {
          this.value = 1;
        } else if (value > maxStock) {
          this.value = maxStock;
        }
        updateQuantity(productId, 0, value);
      });

      function updateQuantity(productId, change, manualValue = null) {
        const formData = new FormData();
        formData.append("product_id", productId);

        if (manualValue !== null) {
          formData.append("quantity", manualValue);
          formData.append("action", "manual");
        } else if (change > 0) {
          formData.append("action", "increase");
        } else {
          formData.append("action", "decrease");
        }

        fetch("/updatecart", {
          method: "POST",
          body: formData,
        })
          .then((response) => {
            if (response.ok) {
              window.location.reload();
            }
          })
          .catch((error) => {
            console.error("Error updating cart:", error);
          });
      }
    });
  };
  productQuantityManagement();
  cartQuantityManagement();
});
