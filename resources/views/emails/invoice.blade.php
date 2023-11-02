<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Order Invoice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        /* body {
            font-family: "Rupee", Arial, sans-serif;
        } */
        @media screen {
            @font-face {
                font-family: 'Source Sans Pro';
                font-style: normal;
                font-weight: 400;
                src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
            }

            @font-face {
                font-family: 'Source Sans Pro';
                font-style: normal;
                font-weight: 700;
                src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
            }
        }

        @page {
            size: A4;
        }

        .invoice-container {
            width: 680px;
            margin: 0 auto;
            padding: 10px;
            border: 1px solid #ccc;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .address-container {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }

        .address {
            display: table-cell;
            width: 50%;
        }

        .invoice-details {
            margin-bottom: 20px;
        }

        .invoice-details table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-details table td {
            padding: 8px;
            border: 1px solid #ccc;
        }

        .invoice-items {
            margin-bottom: 20px;
        }

        .invoice-items table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-items table th {
            background-color: #f2f2f2;
            padding: 8px;
            border: 1px solid #ccc;
            text-align: left;
        }

        .invoice-items table td {
            padding: 8px;
            border: 1px solid #ccc;
        }

        .total {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="logo">
            <img src="https://glosense.in/images/logo.png" alt="Company Logo" width="150">
        </div>

        <div class="address-container">
            <div class="address">
                <strong>From:</strong><br>
                YCT Youth Publication<br>
                12, Church Ln, The Adelphi, Allen Ganj, <br>
                Prayagraj, Uttar Pradesh 211001

            </div>
            <div class="address">
                <strong>To:</strong><br>
                {{ $updateOrder->address }}<br>
                {{ $updateOrder->city . ' - ' . $updateOrder->state }}
                {{ $updateOrder->pincode }}<br>
            </div>
        </div>

        <div class="invoice-details">
            <table>
                <tr>
                    <td>Customer Name</td>
                    <td>{{ $updateOrder->name ?? '' }}</td>
                </tr>
                <tr>
                    <td>Customer Mobile</td>
                    <td>{{ $updateOrder->number ?? '' }}</td>
                </tr>
                <tr>
                    <td>Invoice Number</td>
                    <td>#{{ $updateOrder->id ?? '' }}</td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td>{{ date('F d, Y', strtotime($updateOrder->created_at)) }} </td>
                </tr>
            </table>
        </div>

        <div class="invoice-items">
            <table>
                <tr>
                    <th>Sr No</th>
                    <th>Title</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Hair You Glo</td>
                    <td>{{ $updateOrder->units }}</td>
                    <td>Rs. 1299</td>
                </tr>
                <tr>
                    <td colspan="3">Subtotal:</td>
                    <td>{{ 'Rs. ' . $updateOrder->price }}</td>
                </tr>
                {{-- <tr>
                    <td colspan="3">Discount</td>
                    <td>{{ 'Rs. ' . $updateOrder->discount }}</td>
                </tr> --}}
                <tr>
                    <td colspan="3">Delivery Charges</td>
                    <td>Rs. 0</td>
                </tr>
                <tr>
                    <td colspan="3">Discount</td>
                    <td>{{ 'Rs. ' . $updateOrder->discount }}</td>
                </tr>
                <tr>
                    <td colspan="3">Total:</td>
                    <td>{{ 'Rs. ' . $updateOrder->sub_total }}</td>
                </tr>
            </table>
            <div style="text-align: center;">
                <p>This is a system-generated invoice. No physical signature is required.</p>
            </div>
        </div>
    </div>
</body>

</html>
