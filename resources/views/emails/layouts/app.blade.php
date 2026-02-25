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
                    <!-- HEADER -->
                    <tr>
                        <td style="padding:24px 24px;background:#ffffff;border-bottom:1px solid #eeeeee;">

                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>

                                    <!-- LEFT (optional spacer for balance) -->
                                    <td align="left" valign="middle" style="width:33%;font-size:12px;color:#6b7280;">
                                        &nbsp;
                                    </td>

                                    <!-- CENTER LOGO -->
                                    <td align="center" valign="middle" style="width:34%;">

                                        <img src="https://unxplordsaudi.com/frontend/assets/logo.png"
                                            alt="Unxplord Saudi" style="height:46px;display:block;margin:0 auto;">

                                    </td>

                                    <!-- RIGHT (optional spacer for symmetry) -->
                                    <td align="right" valign="middle" style="width:33%;font-size:12px;color:#6b7280;">
                                        &nbsp;
                                    </td>

                                </tr>
                            </table>

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

                    <!-- FOOTER -->
                    {{-- <tr>
                        <td align="center" style="padding:24px 20px;font-size:12px;color:#8a8a8a;background:#ffffff;">
                            <img src="https://unxplordsaudi.com/frontend/assets/logo.png" alt="Unxplord Saudi"
                                style="height:42px;display:block;"><br />
                            Saudi Arabia Travel Experiences

                            <div style="margin-top:10px;">
                                © {{ date('Y') }} Unxplord Saudi. All rights reserved.
                            </div>

                            <div style="margin-top:8px;">
                                This is an automated email — please do not reply.
                            </div>
                        </td>
                    </tr> --}}

                    <!-- FOOTER -->
                    <tr>
                        <td style="padding:24px 24px;background:#ffffff;border-top:1px solid #eeeeee;">

                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>

                                    <!-- LEFT SIDE -->
                                    <td align="left" valign="top" style="font-size:12px;color:#6b7280;">

                                        <img src="https://unxplordsaudi.com/frontend/assets/logo.png"
                                            alt="Unxplord Saudi" style="height:40px;display:block;margin-bottom:8px;">

                                        <div style="font-size:12px;color:#6b7280;">
                                            Saudi Arabia Travel Experiences
                                        </div>

                                    </td>

                                    <!-- RIGHT SIDE -->
                                    <td align="right" valign="top"
                                        style="font-size:12px;color:#8a8a8a;line-height:1.6;">

                                        <div>
                                            © {{ date('Y') }} Unxplord Saudi
                                        </div>

                                        <div style="margin-top:6px;">
                                            All rights reserved.
                                        </div>

                                        <div style="margin-top:8px;font-size:11px;color:#9ca3af;">
                                            This is an automated email — please do not reply.
                                        </div>

                                    </td>

                                </tr>
                            </table>

                        </td>
                    </tr>

                </table>
                <!-- END CONTAINER -->

            </td>
        </tr>
    </table>

</body>
<?php die(); ?>

</html>
