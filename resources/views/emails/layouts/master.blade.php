<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Unxplord Saudi')</title>
</head>

<body style="margin:0;padding:0;background:#f4f6f8;font-family:Arial,Helvetica,sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f6f8;padding:24px 0;">
        <tr>
            <td align="center">

                <!-- EMAIL CONTAINER -->
                <table width="600" cellpadding="0" cellspacing="0"
                    style="max-width:600px;background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.05);">

                    <!-- ================= HEADER ================= -->
                    <tr>
                        <td
                            style="padding:24px 24px;background:#ffffff;border-bottom:1px solid #eeeeee;text-align:center;">
                            <img src="https://unxplordsaudi.com/frontend/assets/logo.png" alt="Unxplord Saudi"
                                style="height:46px;display:block;margin:0 auto;">
                        </td>
                    </tr>

                    <!-- ================= BODY ================= -->
                    <tr>
                        <td style="padding:32px 28px;color:#333333;font-size:14px;line-height:1.6;">
                            @yield('content')
                        </td>
                    </tr>

                    <!-- ================= FOOTER ================= -->
                    <tr>
                        <td style="padding:22px 24px;background:#ffffff;border-top:1px solid #eeeeee;">

                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>

                                    <!-- LEFT -->
                                    <td align="left" valign="top" style="font-size:12px;color:#6b7280;">
                                        <strong>Unxplord Saudi</strong><br>
                                        Saudi Arabia Travel Experiences
                                    </td>

                                    <!-- RIGHT -->
                                    <td align="right" valign="top"
                                        style="font-size:12px;color:#8a8a8a;line-height:1.6;">
                                        © {{ date('Y') }}<br>
                                        <span style="font-size:11px;color:#9ca3af;">
                                            Automated email — do not reply
                                        </span>
                                    </td>

                                </tr>
                            </table>

                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>
