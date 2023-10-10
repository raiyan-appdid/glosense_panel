<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Order Invoice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        /**
   * Google webfonts. Recommended to include the .woff version for cross-client compatibility.
   */
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

        /**
   * Avoid browser level font resizing.
   * 1. Windows Mobile
   * 2. iOS / OSX
   */
        body,
        table,
        td,
        a {
            -ms-text-size-adjust: 100%;
            /* 1 */
            -webkit-text-size-adjust: 100%;
            /* 2 */
        }

        /**
   * Remove extra space added to tables and cells in Outlook.
   */
        table,
        td {
            mso-table-rspace: 0pt;
            mso-table-lspace: 0pt;
        }

        /**
   * Better fluid images in Internet Explorer.
   */
        img {
            -ms-interpolation-mode: bicubic;
        }

        /**
   * Remove blue links for iOS devices.
   */
        a[x-apple-data-detectors] {
            font-family: inherit !important;
            font-size: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
            color: inherit !important;
            text-decoration: none !important;
        }

        /**
   * Fix centering issues in Android 4.4.
   */
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }

        body {
            width: 100% !important;
            height: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        /**
   * Collapse table borders to avoid space between cells.
   */
        table {
            border-collapse: collapse !important;
        }

        a {
            color: #1a82e2;
        }

        img {
            height: auto;
            line-height: 100%;
            text-decoration: none;
            border: 0;
            outline: none;
        }
    </style>

</head>

<body style="background-color: #D2C7BA;">

    {{-- @dump($updateOrder) --}}
    <!-- start preheader -->
    <div class="preheader"
        style="display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;">
        Here is a summary of your recent order. If you have any questions or concerns about your order, please <a
            href="https://glosense.in">contact us.</a>
    </div>
    <!-- end preheader -->

    <!-- start body -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%">

        <!-- start logo -->
        <tr>
            <td align="center" bgcolor="#D2C7BA">

                {{-- <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="center" valign="top" style="padding: 36px 24px;">
                            <a href="https://maryammanemaddu.com/" target="_blank" style="display: inline-block;">
                                <img src="https://maryammanemaddu.com/images/logo/favicon.ico" alt="Logo"
                                    border="0" width="48"
                                    style="display: block; width: 48px; max-width: 48px; min-width: 48px;">
                            </a>
                        </td>
                    </tr>
                </table> --}}

            </td>
        </tr>
        <!-- end logo -->

        <!-- start hero -->
        <tr>
            <td align="center" bgcolor="#D2C7BA">

                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="left" bgcolor="#ffffff"
                            style="padding: 36px 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;">
                            <h1
                                style="margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">
                                Thank you for your order!</h1>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!-- end hero -->

        <!-- start copy block -->
        <tr>
            <td align="center" bgcolor="#D2C7BA">

                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

                    <!-- start copy -->
                    <tr>
                        <td align="left" bgcolor="#ffffff"
                            style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                            <p style="margin: 0;">Here is a summary of your recent order. If you have any questions or
                                concerns about your order, please <a href="https://glosense.in">contact
                                    us</a>.</p>
                        </td>
                    </tr>
                    <!-- end copy -->

                    <!-- start receipt table -->
                    <tr>
                        <td align="left" bgcolor="#ffffff"
                            style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="left" width="50%">
                                        <strong>Order #</strong>
                                    </td>
                                    <td align="right" width="20%"
                                        style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                                        <strong>{{ $updateOrder->order_id }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" bgcolor="#D2C7BA" width="50%"
                                        style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                                        <strong>Items #</strong>
                                    </td>
                                    <td align="left" bgcolor="#D2C7BA" width="20%"
                                        style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                                        <strong>Qty</strong>
                                    </td>
                                    <td align="left" bgcolor="#D2C7BA" width="30%"
                                        style="padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;white-space: nowrap;">
                                        <strong>Price</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" width="50%"
                                        style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                                        {{ $updateOrder->product_name ?? '' }}</td>
                                    <td align="left" width="20%"
                                        style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                                        {{ $updateOrder->units ?? '' }}</td>
                                    <td align="left" width="30%"
                                        style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; white-space: nowrap;">
                                        ₹ {{ $updateOrder->price ?? '' }}</td>

                                </tr>
                                <tr>
                                    <td align="left" width="75%"
                                        style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                                        Shipping</td>
                                    <td align="left" width="20%"
                                        style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                                    </td>
                                    <td align="left" width="25%"
                                        style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; white-space: nowrap;">
                                        ₹ 0</td>

                                </tr>
                                <tr>
                                    <td align="left" width="75%"
                                        style="padding: 12px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; border-top: 2px dashed #D2C7BA; border-bottom: 2px dashed #D2C7BA;">
                                        <strong>Total</strong>
                                    </td>
                                    <td align="left" width="20%"
                                        style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; border-top: 2px dashed #D2C7BA; border-bottom: 2px dashed #D2C7BA;">
                                    </td>
                                    <td align="left" width="25%"
                                        style="padding: 12px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; border-top: 2px dashed #D2C7BA; border-bottom: 2px dashed #D2C7BA; white-space: nowrap;">
                                        <strong>₹ {{ $updateOrder->sub_total ?? '' }}</strong>
                                    </td>

                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- end reeipt table -->

                </table>

            </td>
        </tr>
        <!-- end copy block -->

        <!-- start receipt address block -->
        <tr>
            <td align="center" bgcolor="#D2C7BA" valign="top" width="100%">

                <table align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="100%"
                    style="max-width: 600px;">
                    <tr>
                        <td align="center" valign="top" style="font-size: 0; border-bottom: 3px solid #d4dadf">
                            <div
                                style="display: inline-block; width: 100%; max-width: 50%; min-width: 240px; vertical-align: top;">
                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%"
                                    style="max-width: 300px;">
                                    <tr>
                                        <td align="left" valign="top"
                                            style="padding-bottom: 36px; padding-left: 36px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                                            <p><strong>Delivery Address</strong></p>
                                            <p>{{ $updateOrder->address}},<br>{{ $updateOrder->city }},<br>{{ $updateOrder->state }},
                                                {{ $updateOrder->pincode ?? '' }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div
                                style="display: inline-block; width: 100%; max-width: 50%; min-width: 240px; vertical-align: top;">
                                {{-- <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%"
                                    style="max-width: 300px;">
                                    <tr>
                                        <td align="left" valign="top"
                                            style="padding-bottom: 36px; padding-left: 36px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                                            <p><strong>Billing Address</strong></p>
                                            <p>{{ $delivery_address?->address_one ?? '' }},<br>{{ $delivery_address?->address_two ?? '' . ' ' ."vapi" ?? '' }},<br>{{ "state" ?? '' }},
                                                {{ $delivery_address?->pincode ?? '' }}</p>
                                        </td>
                                    </tr>
                                </table> --}}
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" bgcolor="#D2C7BA" style="padding: 24px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

                    <!-- start permission -->
                    <tr>
                        <td align="center" bgcolor="#D2C7BA"
                            style="padding: 12px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;">
                            <p style="margin: 0;">You received this email because we received a product request. If you
                                didn't request product you can safely
                                delete this email.</p>
                        </td>
                    </tr>
                    <!-- end permission -->


                </table>
            </td>
        </tr>
        <!-- end footer -->

    </table>
    <!-- end body -->

</body>

</html>
