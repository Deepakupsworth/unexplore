<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Unxplord Saudi')</title>
</head>

<body style="margin:0;padding:0;background:#f4f6f8;font-family:Arial,Helvetica,sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f6f8;padding:20px 0;">
        <tr>
            <td align="center">

                <!-- EMAIL CONTAINER -->
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.05);">

                    <!-- ================= HEADER ================= -->
                    <tr>
                        <td style="background:#0a6b3c;padding:22px;text-align:center;">
                            <img src="https://unxplordsaudi.com/frontend/assets/logo-white.png" alt="Unxplord Saudi"
                                style="height:42px;">
                        </td>
                    </tr>

                    <!-- ================= BODY ================= -->
                    <tr>
                        <td style="padding:32px;color:#333;">
                            @yield('content')
                        </td>
                    </tr>

                    <!-- ================= FOOTER ================= -->
                    <tr>
                        <td style="background:#f8fafc;padding:20px;text-align:center;font-size:12px;color:#6b7280;">

                            <p style="margin:0 0 8px 0;">
                                © {{ date('Y') }} <strong>Unxplord Saudi</strong>
                            </p>

                            <p style="margin:0;">
                                This is an automated email. Please do not reply.
                            </p>

                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
