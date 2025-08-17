<?php $this->view('includes/header', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php $this->view('includes/sidebar', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>
        <!-- End Sidebar -->

        <div class="main-panel">

            <?php $this->view('includes/navbar', ['crumbs' => $crumbs, 'actives' => $actives, 'hiddenSearch' => $hiddenSearch,]) ?>

            <div class="container">
                <div class="page-inner">
                    <div class="page-header">
                        <h3 class="fw-bold mb-3">My Sales: GHC <?= esc(number_format($rowssales, 2)) ?></h3>
                        <ul class="breadcrumbs mb-3">
                            <li class="nav-home">
                                <a href="#">
                                    <i class="icon-home"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">Forms</a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">Make Sales</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Grid Layout for Product Table and Cart Table -->
                    <div class="row">
                        <!-- Product Search Form -->
                        <div class="col-md-6">
                            <div class="table-responsive" style="height:800px; overflow-y:scroll;">
                                <h4>Available Products</h4>
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <input type="text" class="form-control" id="productSearch" placeholder="Search products by name">
                                    </div>
                                </div>
                                <table class="table table-bordered" id="productTable">
                                    <thead>
                                        <tr>
                                            <th style="width:45%">Product Name</th>
                                            <th style="width:15%">Price</th>
                                            <th style="width:10%">Quantity</th>
                                            <th style="width:20%">Add to Cart</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Product rows will be dynamically added here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <form id="cartForm" method="POST">
                                <div class="table-responsive" style="height:400px; overflow-y:scroll;">
                                    <h4 class="">Cart</h4>
                                    <table class="table table-bordered" id="cartTable">
                                        <thead>
                                            <tr>
                                                <th style="width:45%">Product Name</th>
                                                <th style="width:15%">Price</th>
                                                <th style="width:10%">Quantity</th>
                                                <th style="width:20%">Remove</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Cart items will be dynamically added here -->
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-between mt-4">
                                    <div class="form-group mb-4 col-md-8">
                                        <label for="customerSelect">Select Customer:</label>
                                        <select name="customid" id="customerSelect" class="form-control">
                                            <option value="">Select a Customer</option>
                                            <?php if ($customers): ?>
                                                <?php foreach ($customers as $cust): ?>
                                                    <option value="<?= esc($cust->custid) ?>"><?= esc($cust->custname) ?></option>
                                                <?php endforeach; ?>
                                            <?php endif ?>
                                            <!-- Dynamic customer options will be added here -->
                                        </select>
                                    </div>

                                    <div class="form-group mb-4 col-md-2">
                                        <label for="creditOption">Credit Option:</label>
                                        <select name="credited" id="creditOption" class="form-control">
                                            <option value="">Select</option>
                                            <option value="NO">NO</option>
                                            <option value="YES">YES</option>
                                        </select>
                                    </div>

                                    <div class="form-group mb-4 col-md-2">
                                        <label for="amountInput">Amount:</label>
                                        <input name="depositamount" type="text" id="amountInput" class="form-control">
                                    </div>
                                </div>

                                <script>
                                    $(document).ready(function() {
                                        // Function to check conditions and update required status for amount input
                                        function checkAmountRequirement() {
                                            const customerSelected = $('#customerSelect').val() !== ""; // Check if customer is selected
                                            const creditOption = $('#creditOption').val(); // Check the credit option

                                            // If customer is selected and credit option is "YES", make amount input required
                                            if (customerSelected && creditOption === "YES") {
                                                $('#amountInput').prop('required', true);
                                            } else {
                                                $('#amountInput').prop('required', false);
                                            }
                                        }

                                        // Trigger the function on change of customer or credit option
                                        $('#customerSelect, #creditOption').on('change', function() {
                                            checkAmountRequirement(); // Check condition whenever the customer or credit option changes
                                        });

                                        // Initialize check when the page loads
                                        checkAmountRequirement();
                                    });
                                </script>



                                <div id="cartFooter">
                                    <div class="alert alert-warning">
                                        <h4><strong>Total:</strong> <span id="subtotalFooter">GHC 0.00</span></h4>
                                    </div>
                                    <div class="">
                                        <button class="btn btn-primary my-2 w-100 py-4" id="makePurchaseBtn" type="submit">Make Purchase</button>
                                        <!-- <button class="btn btn-secondary my-2 w-100" id="printPreviewBtn" type="button">Print Preview</button> -->
                                        <button class="btn btn-danger my-2 w-100" id="clearCartBtn" type="button">Clear Cart</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                    // PHP data passed as a JavaScript variable
                    const products = <?php echo json_encode($productdata); ?>;

                    $(document).ready(function() {
                        const cart = [];

                        // Display products in the product table
                        function displayProducts(productList) {
                            $('#productTable tbody').empty();
                            productList.forEach(function(product) {
                                const row = `
                                    <tr data-id="${product.id}">
                                        <td style="width:45%">${product.pro_name}</td>
                                        <td style="width:15%">GHC ${product.selling_price}</td>
                                        <td style="width:10%">${product.quantity}</td> <!-- Display Quantity -->
                                        <td style="width:20%">
                                            <button class="btn btn-warning add-to-cart-btn" ${product.quantity <= 0 ? 'disabled' : ''}>Add</button>
                                        </td>
                                    </tr>
                                `;
                                $('#productTable tbody').append(row);
                            });
                        }

                        // Initial display of products
                        displayProducts(products);

                        // Handle product search (search by name)
                        $('#productSearch').on('input', function() {
                            const searchTerm = $(this).val().toLowerCase();
                            $('#productTable tbody tr').each(function() {
                                const productName = $(this).find('td').eq(0).text().toLowerCase(); // Search by product name
                                if (productName.includes(searchTerm)) {
                                    $(this).show();
                                } else {
                                    $(this).hide();
                                }
                            });
                        });

                        // Handle Add to Cart button
                        $('#productTable').on('click', '.add-to-cart-btn', function() {
                            const productRow = $(this).closest('tr');
                            const productId = parseInt(productRow.data('id'));
                            const product = products.find(p => p.id === productId);

                            if (product.quantity > 0) {
                                const cartItem = cart.find(item => item.id === product.id);
                                if (cartItem) {
                                    cartItem.quantity += 1;
                                } else {
                                    cart.push({
                                        ...product,
                                        quantity: 1
                                    });
                                }

                                product.quantity -= 1; // Reduce quantity in the available products list
                                displayProducts(products); // Update the product list
                                updateCartTable();
                            }
                        });

                        // Update cart table
                        function updateCartTable() {
                            $('#cartTable tbody').empty();
                            let subtotal = 0;

                            cart.forEach(function(item) {
                                const row = `
                                    <tr data-id="${item.id}">
                                        <td style="width:45%">
                                            <input type="hidden" name="product_ids[]" value="${item.productid}">
                                            ${item.pro_name}
                                        </td>
                                        <td style="width:15%">GHC ${item.selling_price}</td>
                                        <td style="width:10%">
                                            <input type="number" name="quantities[]" class="form-control quantity-input" value="${item.quantity}" min="1">
                                        </td>
                                        <td style="width:20%"><button class="btn btn-danger remove-from-cart-btn">Remove</button></td>
                                    </tr>
                                `;
                                $('#cartTable tbody').append(row);
                                subtotal += item.selling_price * item.quantity;
                            });

                            $('#subtotalFooter').text(`GHC ${subtotal.toFixed(2)}`);
                        }

                        // Remove from cart
                        $('#cartTable').on('click', '.remove-from-cart-btn', function() {
                            const productRow = $(this).closest('tr');
                            const productId = parseInt(productRow.data('id'));
                            const productIndex = cart.findIndex(item => item.id === productId);

                            if (productIndex > -1) {
                                const removedProduct = cart.splice(productIndex, 1)[0];
                                // Increase the product quantity back in the available products list
                                const product = products.find(p => p.id === removedProduct.id);
                                product.quantity += removedProduct.quantity;
                                displayProducts(products); // Update the product list
                                updateCartTable();
                            }
                        });

                        // Update product quantity when cart quantity is changed
                        $('#cartTable').on('input', '.quantity-input', function() {
                            const cartRow = $(this).closest('tr');
                            const productId = parseInt(cartRow.data('id'));
                            const newQuantity = parseInt($(this).val());

                            const cartItem = cart.find(item => item.id === productId);
                            const product = products.find(p => p.id === productId);

                            // Update cart and available quantity
                            if (newQuantity > cartItem.quantity) {
                                const quantityDifference = newQuantity - cartItem.quantity;
                                if (product.quantity >= quantityDifference) {
                                    product.quantity -= quantityDifference; // Reduce product quantity
                                    cartItem.quantity = newQuantity; // Update cart quantity
                                } else {
                                    $(this).val(cartItem.quantity); // Revert to old quantity if not enough stock
                                }
                            } else if (newQuantity < cartItem.quantity) {
                                const quantityDifference = cartItem.quantity - newQuantity;
                                product.quantity += quantityDifference; // Increase product quantity
                                cartItem.quantity = newQuantity; // Update cart quantity
                            }

                            displayProducts(products); // Update the product list
                            updateCartTable(); // Update the cart table
                        });

                        // Clear cart
                        $('#clearCartBtn').on('click', function() {
                            cart.length = 0;
                            // Reset all product quantities in the product list
                            if (!products === 0) {
                                products.forEach(product => {
                                    product.quantity = product.originalQuantity; // Assuming originalQuantity is stored in the PHP data.
                                });
                            }
                            displayProducts(products);
                            updateCartTable();
                        });


                    });
                </script>

                <!-- <script>
                    $(document).ready(function() {
                        $("#printPreviewBtn").on("click", function() {
                            let printWindow = window.open('', '_blank');
                            let cartContent = "<html><head><title>Print Preview</title></head><body>";
                            cartContent += "<h2>Cart Summary</h2><table border='1' width='100%'><tr><th>Product Name</th><th>Price</th><th>Quantity</th></tr>";

                            $('#cartTable tbody tr').each(function() {
                                let productName = $(this).find('td').eq(0).text();
                                let productPrice = $(this).find('td').eq(1).text();
                                let productQuantity = $(this).find('.quantity-input').val();
                                cartContent += `<tr><td>${productName}</td><td>${productPrice}</td><td>${productQuantity}</td></tr>`;
                            });

                            cartContent += "</table><br><button onclick='window.print()'>Print</button></body></html>";
                            printWindow.document.write(cartContent);
                            printWindow.document.close();
                        });
                    });
                </script> -->

            </div>
            <!-- Bootstrap JS -->
            <?php $this->view('includes/footer'/*, ['crumbs'=>$crumbs, 'actives'=>$actives]*/) ?>