<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Unxplord Saudi')</title>
</head>

<body style="margin:0;padding:0;background-color:#f4f6f8;font-family:Arial,Helvetica,sans-serif;">

    <!-- PREHEADER (hidden preview text) -->
    <div style="display:none;max-height:0;overflow:hidden;opacity:0;">
        Your Unxplord Saudi booking details inside.
    </div>

    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f4f6f8;">
        <tr>
            <td align="center" style="padding:30px 15px;">

                <!-- MAIN CONTAINER -->
                <table width="600" cellpadding="0" cellspacing="0" border="0"
                    style="max-width:600px;background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 4px 18px rgba(0,0,0,0.06);">

                    <!-- HEADER -->
                    <tr>
                        <td align="center"
                            style="background:linear-gradient(135deg,#0a6b3c,#0f8f52);padding:26px 20px;">
                            <img src="https://unxplordsaudi.com/frontend/assets/logo-white.png" alt="Unxplord Saudi"
                                style="height:42px;display:block;">
                        </td>
                    </tr>

                    <!-- CONTENT -->
                    <tr>
                        <td style="padding:32px 30px;color:#333333;font-size:14px;line-height:1.6;">
                            @yield('content')
                        </td>
                    </tr>

                    <!-- DIVIDER -->
                    <tr>
                        <td style="padding:0 30px;">
                            <hr style="border:none;border-top:1px solid #eeeeee;margin:0;">
                        </td>
                    </tr>

                    <!-- SUPPORT BOX -->
                    <tr>
                        <td style="padding:22px 30px;background:#fafafa;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="font-size:13px;color:#666;">
                                        Need help with your booking?<br>
                                        Contact our support team anytime.
                                    </td>
                                    <td align="right">
                                        <a href="#"
                                            style="background:#0a6b3c;color:#ffffff;text-decoration:none;
                                      padding:10px 18px;border-radius:6px;font-size:13px;
                                      display:inline-block;font-weight:bold;">
                                            Contact Support
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- FOOTER -->
                    <tr>
                        <td align="center" style="padding:24px 20px;font-size:12px;color:#8a8a8a;background:#ffffff;">

                            <strong style="color:#333;">Unxplord Saudi</strong><br>
                            Saudi Arabia Travel Experiences

                            <div style="margin-top:10px;">
                                © {{ date('Y') }} Unxplord Saudi. All rights reserved.
                            </div>

                            <div style="margin-top:8px;">
                                This is an automated email — please do not reply.
                            </div>
                        </td>
                    </tr>

                </table>
                <!-- END CONTAINER -->

            </td>
        </tr>
    </table>

</body>

</html>

