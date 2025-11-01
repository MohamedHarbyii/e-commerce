<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Store!</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 0; background-color: #f4f4f4;">

<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f4f4f4; padding: 20px;">
    <tr>
        <td align="center">

            <table width="600" cellpadding="0" cellspacing="0" border="0"
                   style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">

                <tr>
                    <td style="padding: 40px 30px 20px 30px; text-align: center; background-color: #007bff; color: #ffffff; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                        <h1 style="margin: 0; font-size: 28px;">Welcome to Our Store!</h1>
                    </td>
                </tr>

                <tr>
                    <td style="padding: 40px 30px; color: #333333; font-size: 16px;">

                        <h2 style="margin-top: 0; margin-bottom: 25px; color: #333;">Hi {{$user->name}},</h2>

                        <p style="margin-bottom: 20px;">
                            We’re so excited to have you join our e-commerce community! Your account has been created successfully.
                        </p>

                        <p style="margin-bottom: 20px;">
                            You can now log in, browse our latest products, and enjoy a seamless shopping experience.
                        </p>

                        <p style="margin-bottom: 20px;">
                            If you have any questions or need help, our support team is always here for you.
                        </p>

                        <p style="margin-bottom: 0;">
                            Thanks for joining us,<br>
                            The <strong>{{ config('app.name') }}</strong> Team
                        </p>
                    </td>
                </tr>

                <tr>
                    <td style="padding: 30px; text-align: center; color: #888888; font-size: 12px; border-top: 1px solid #eeeeee;">
                        &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>

</body>
</html>
