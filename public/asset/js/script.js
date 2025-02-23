const navEL = document.querySelector(".navbar");
window.addEventListener("scroll", () => {
    if (window.scrollY >= 806) {
        navEL.classList.add("navbar-scrolled");
    } else if (window.scrollY < 806) {
        navEL.classList.remove("navbar-scrolled");
    }
});

document.addEventListener("DOMContentLoaded", function () {
    // make it as accordion for smaller screens
    if (window.innerWidth > 992) {
        document
            .querySelectorAll(".navbar .nav-item")
            .forEach(function (everyitem) {
                everyitem.addEventListener("mouseover", function (e) {
                    let el_link = this.querySelector("a[data-bs-toggle]");

                    if (el_link != null) {
                        let nextEl = el_link.nextElementSibling;
                        el_link.classList.add("show");
                        nextEl.classList.add("show");
                    }
                });
                everyitem.addEventListener("mouseleave", function (e) {
                    let el_link = this.querySelector("a[data-bs-toggle]");

                    if (el_link != null) {
                        let nextEl = el_link.nextElementSibling;
                        el_link.classList.remove("show");
                        nextEl.classList.remove("show");
                    }
                });
            });
    }
    // end if innerWidth
});
// DOMContentLoaded  end

const workSection = document.querySelector(".overview");

const workSectionObserve = (entries) => {
    const [entry] = entries;
    if (!entry.isIntersecting) return;
    console.log(entries);

    const counterNum = document.querySelectorAll(".counter");
    // console.log(counterNum);
    const speed = 200;

    counterNum.forEach((curNumber) => {
        const updateNumber = () => {
            const targetNumber = parseInt(curNumber.dataset.number);
            // console.log(targetNumber);
            const initialNumber = parseInt(curNumber.innerText);
            // console.log(initialNumber);
            const incrementNumber = Math.trunc(targetNumber / speed);
            // i am adding the value to the main number
            // console.log(incrementNumber);

            if (initialNumber < targetNumber) {
                curNumber.innerText = `${initialNumber + incrementNumber}`;
                setTimeout(updateNumber, 10);
            } else {
                curNumber.innerText = `${targetNumber}`;
            }
        };
        updateNumber();
    });
};

const workSecObserver = new IntersectionObserver(workSectionObserve, {
    root: null,
    threshold: 0,
});

// workSecObserver.observe(workSection);

const toTop = document.querySelector(".to-top");

window.addEventListener("scroll", () => {
    if (window.scrollY > 390) {
        toTop.classList.add("active");
    } else {
        toTop.classList.remove("active");
    }
});

class Cart {
    constructor() {
        this.items = JSON.parse(localStorage.getItem("cart")) || [];
        this.total = 0;
        this.updateCartCount();
        this.calculateTotal();
    }

    addItem(product) {
        const existingItem = this.items.find((item) => item.id === product.id);

        if (existingItem) {
            existingItem.quantity += product.quantity;
        } else {
            // kae path img
            if (window.location.pathname.includes("/pages/")) {
                product.image = product.image.replace("../", "/");
            }
            this.items.push(product);
        }

        this.saveCart();
        this.updateCartCount();
        this.calculateTotal();
        console.log("Added item:", product);
        console.log("Current cart:", this.items);
    }

    removeItem(productId) {
        this.items = this.items.filter((item) => item.id !== productId);
        this.saveCart();
        this.updateCartCount();
        this.calculateTotal();
        this.renderCartItems();
    }

    updateQuantity(productId, quantity) {
        const item = this.items.find((item) => item.id === productId);
        if (item) {
            item.quantity = parseInt(quantity);
            if (item.quantity <= 0) {
                this.removeItem(productId);
            }
        }
        this.saveCart();
        this.calculateTotal();
        this.renderCartItems();
    }

    // dak local
    saveCart() {
        localStorage.setItem("cart", JSON.stringify(this.items));
    }

    updateCartCount() {
        const count = this.items.reduce(
            (total, item) => total + item.quantity,
            0
        );
        const countElements = document.querySelectorAll(".count");
        countElements.forEach((element) => {
            element.textContent = count;
        });
    }

    // Calculate total price
    calculateTotal() {
        this.total = this.items.reduce(
            (total, item) => total + item.price * item.quantity,
            0
        );
        const subtotalElement = document.getElementById("cart-subtotal");
        const totalElement = document.getElementById("cart-total");

        if (subtotalElement) {
            subtotalElement.textContent = `$${this.total.toFixed(2)}`;
        }
        if (totalElement) {
            totalElement.textContent = `$${this.total.toFixed(2)}`;
        }

        return this.total;
    }
    renderCartItems() {
        const cartContainer = document.getElementById("cart-products-display");
        const productsAmount = document.getElementById("productamount");
        productsAmount.textContent = this.items.length;
        if (!cartContainer) return;

        if (this.items.length === 0) {
            cartContainer.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center">Your cart is empty</td>
                </tr>
            `;
            return;
        }

        cartContainer.innerHTML = this.items
            .map(
                (item) =>
                    `
            <tr>
                <td class="text-center">
                    <button type="button" class="btn btn-danger" onclick="cart.removeItem('${
                        item.id
                    }')">
                        <span>&times;</span>
                    </button>
                </td>
                <td class="text-center">
                    <img src="${item.image}" alt="${
                        item.name
                    }" class="img-fluid" style="max-width: 50px;">
                </td>
                <td class="text-center">${item.name}</td>
                <td class="text-center">$${item.price.toFixed(2)}</td>
                <td class="text-center">
                    <div class="d-flex align-items-center justify-content-center">
                        <button class="btn btn-sm btn-outline-secondary" onclick="cart.updateQuantity('${
                            item.id
                        }', ${item.quantity - 1})">-</button>
                         <input type="text" class="form-control text-center" value="${
                             item.quantity
                         }"
                                onchange="cart.updateQuantity('${
                                    item.id
                                }', this.value)"/>
<button class="btn btn-sm btn-outline-secondary"  onclick="cart.updateQuantity('${
                        item.id
                    }', ${item.quantity + 1})">+</button>
                    </div>
                </td>
<td class="text-center">$${(item.price * item.quantity).toFixed(2)}</td>
            </tr>`
            )
            .join("");
    }

    renderCheckoutItems() {
        const checkoutTable = document.querySelector(
            ".site-block-order-table tbody"
        );
        if (!checkoutTable) return;

        if (this.items.length === 0) {
            checkoutTable.innerHTML = `
                <tr>
                    <td colspan="2" class="text-center">Your cart is empty</td>
                </tr>
            `;
            return;
        }
        let html = "";
        this.items.forEach((item) => {
            html += `
                <tr>
                    <td>${item.name} <strong class="mx-2">×</strong> ${
                item.quantity
            }</td>
                    <td>$${(item.price * item.quantity).toFixed(2)}</td>
                </tr>
            `;
        });
        html += `
            <tr>
                <td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
                <td class="text-black">$${this.total.toFixed(2)}</td>
            </tr>
        `;
        html += `
            <tr>
                <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                <td class="text-black font-weight-bold"><strong>$${this.total.toFixed(
                    2
                )}</strong></td>
            </tr>
        `;

        checkoutTable.innerHTML = html;
    }
}

// create new cart
const cart = new Cart();
document.querySelectorAll(".buy-now").forEach((button) => {
    button.addEventListener("click", (e) => {
        e.preventDefault();

        const productContainer = e.target.closest(".site-section");
        if (!productContainer) return;

        const quantity =
            parseInt(productContainer.querySelector(".form-control").value) ||
            1;
        const imgElement = productContainer.querySelector(".img-fluid");
        let imagePath = "";
        if (imgElement) {
            imagePath = imgElement.getAttribute("src");
            console.log("Image path found:", imagePath);
        }

        const product = {
            id: window.location.pathname.split("/").pop().replace(".html", ""),
            name: productContainer.querySelector("h2").textContent.trim(),
            price: parseFloat(
                productContainer
                    .querySelector(".text-primary")
                    .textContent.replace("$", "")
            ),
            image: imagePath,
            quantity: quantity,
        };
        // merl item
        console.log("Adding product:", product);

        cart.addItem(product);
        window.location.href = window.location.pathname.includes("/pages/")
            ? "../carts.html"
            : "carts.html";
    });
});
if (window.location.pathname.includes("carts.html")) {
    console.log("Rendering cart items...");
    console.log("Current cart contents:", cart.items);
    cart.renderCartItems();
    cart.renderCheckoutItems();
}
// if (window.location.pathname.includes("checkout.html")) {
//     console.log("Rendering checkout items...");

// }

class PayPalHandler {
    constructor() {
        this.clientId =
            "AVMFTyq3FE5MbjT86Pyf75LPkRb5xiCEo3UOCb_9ADWHxtk_yWmMGl2O3_om4DCYxoBaALX8L2n66fQU";
        this.loadPayPalScript();
    }

    loadPayPalScript() {
        const script = document.createElement("script");
        script.src = `https://www.paypal.com/sdk/js?client-id=${this.clientId}&currency=USD`;
        script.async = true;
        script.onload = () => this.initializePayPalButton();
        document.body.appendChild(script);
    }

    initializePayPalButton() {
        const paypalButtonContainer = document.getElementById(
            "paypal-button-container"
        );
        if (!paypalButtonContainer) return;

        paypal
            .Buttons({
                createOrder: (data, actions) => {
                    const cartTotal = cart.calculateTotal();
                    return actions.order.create({
                        purchase_units: [
                            {
                                amount: {
                                    value: cartTotal.toFixed(2),
                                },
                            },
                        ],
                    });
                },
                onApprove: (data, actions) => {
                    return actions.order.capture().then((details) => {
                        localStorage.removeItem("cart");
                        cart.items = [];
                        cart.updateCartCount();
                    });
                },
                onError: (err) => {
                    console.error("PayPal Error:", err);
                    alert(
                        "There was an error processing your payment. Please try again."
                    );
                },
            })
            .render("#paypal-button-container");
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const paypalHandler = new PayPalHandler();
});
if (document.getElementById("paypal-button-container")) {
    paypal
        .Buttons({
            createOrder: function (data, actions) {
                return actions.order.create({
                    purchase_units: [
                        {
                            amount: {
                                value: cart.total.toFixed(2),
                            },
                        },
                    ],
                });
            },
            onApprove: function (data, actions) {
                return actions.order.capture().then(function (details) {
                    localStorage.removeItem("cart");
                    cart.items = [];
                    cart.updateCartCount();
                });
            },
        })
        .render("#paypal-button-container");
}
