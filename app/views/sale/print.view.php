<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .invoice-container {
            background: #fff;
            max-width: 750px;
            margin: 20px auto;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
            border-radius: 8px;
            padding: 20px 20px 20px 20px;
        }

        h2 {
            text-align: right;
            letter-spacing: 2px;
            margin-bottom: 5px;
            color: #333;
        }

        .invoice-details {
            margin-bottom: 1px;
            font-size: 12px;
        }

        .invoice-details p {
            margin: 7px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th,
        td {
            padding: 5px 8px;
            text-align: left;
            font-size: 12px;
        }

        th {
            background: #f1f3f6;
            color: #222;
            font-weight: 600;
            border-bottom: 2px solid #e0e0e0;
            font-size: 16px;
        }

        td {
            border-bottom: 1px solid #e0e0e0;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .total-row td {
            font-size: 16px;
            font-weight: bold;
            background: #f9fafb;
            color: #222;
        }

        .print-btn {
            display: block;
            margin: 0 auto;
            padding: 12px 32px;
            border: 2px solid #222;
            background: #fff;
            color: #222;
            font-size: 16px;
            border-radius: 24px;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
        }

        .print-btn:hover {
            background: #222;
            color: #fff;
        }

        @media print {
            body {
                background: none;
            }

            .invoice-container {
                box-shadow: none;
                border-radius: 0;
                padding: 0;
                margin: -5;
            }

            .print-btn {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="invoice-container">
        <!-- Invoice Header -->
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">

            <!-- Logo on the left -->
            <?php if (!empty($shop->logo)):
                $imageUrl = "";
                if ($shop->logo) {
                    $imageUrl = ROOT . "/" . $shop->logo;
                }
            ?>
                <div style="flex-shrink: 0;">
                    <img src="<?= esc($imageUrl) ?>" alt="Shop Logo" style="max-width:100px; max-height:100px; border-radius:8px;">
                </div>
            <?php endif; ?>

            <!-- Shop name + Invoice on the right -->
            <div style="text-align: right;">
                <h2 style="margin: 0;">Invoice</h2>
                <h2 style="margin: 0;"><?= $shop->shopname ?></h2>
            </div>
        </div>

        <!-- Invoice Details -->
        <div class="invoice-details" style="display: flex; flex-wrap: wrap; gap: 32px; margin-bottom: 20px;">
            <div style="flex: 1; min-width: 200px;">
                <p><strong>Date:</strong> <?= date("Y-m-d") ?></p>
                <p><strong>Order Number:</strong> <?= $sales[0]->ordernumber ?></p>
            </div>
            <div style="flex: 1; min-width: 200px;">
                <p><strong>Customer:</strong> <?= $customer ?></p>
                <p><strong>Attendant:</strong>
                    <?= Auth::getFirstname() ?> <?= Auth::getLastname() ?>
                    - <b><?= Auth::getUsername() ?></b>
                </p>
            </div>
        </div>


        <table style="border: 1px solid #ccc;">
            <tr>
                <th style="border: 1px solid #ccc;">Product</th>
                <th style="text-align:center; border: 1px solid #ccc;">Quantity</th>
                <th style="text-align:right; border: 1px solid #ccc;">Price</th>
                <th style="text-align:right; border: 1px solid #ccc;">Total</th>
            </tr>
            <?php
            $total = 0;
            foreach ($sales as $sale) :
                $subtotal = $sale->quantity * $sale->price;
                $total += $subtotal;
            ?>
                <tr>
                    <td style="border: 1px solid #ccc;"><?= $sale->product->pro_name ?></td>
                    <td style="text-align:center; border: 1px solid #ccc;"><?= $sale->quantity ?></td>
                    <td style="text-align:right; border: 1px solid #ccc;">GHC <?= number_format($sale->price, 2) ?></td>
                    <td style="text-align:right; border: 1px solid #ccc;">GHC <?= number_format($subtotal, 2) ?></td>
                </tr>
            <?php endforeach; ?>
            <tr class="total-row">
                <td colspan="3" style="border: 1px solid #ccc;">Total</td>
                <td style="text-align:right; border: 1px solid #ccc;">GHC <?= number_format($total, 2) ?></td>
            </tr>
        </table>

        <button class="print-btn" onclick="window.print()">Print</button>
    </div>

</body>

</html>