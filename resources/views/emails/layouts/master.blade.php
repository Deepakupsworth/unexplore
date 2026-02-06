<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Unxplord Saudi')</title>
</head>

<body style="margin:0;padding:0;background:#f4f6f8;font-family:Arial,Helvetica,sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">

                <!-- EMAIL CONTAINER -->
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background:#ffffff;border-radius:10px;overflow:hidden;margin:40px 0;">

                    <!-- HEADER -->
                    <tr>
                        <td style="background:#0a6b3c;padding:20px;text-align:center;">
                            <img src="{{ asset('/frontend/assets/logo.png') }}" alt="Unxplord Saudi"
                                style="height:40px;">
                        </td>
                    </tr>

                    <!-- BODY -->
                    <tr>
                        <td style="padding:30px;color:#333;">
                            @yield('content')
                        </td>
                    </tr>

                    <!-- FOOTER -->
                    <tr>
                        <td style="background:#f4f6f8;padding:15px;text-align:center;font-size:12px;color:#777;">
                            © {{ date('Y') }} <strong>Unxplord Saudi</strong>
                            <br>
                            This is an automated email. Please do not reply.
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
