<!DOCTYPE html>
<html>
<body style="background-color: #f4f4f4; font-family: sans-serif; margin: 0; padding: 0;">
    <table cellpadding="0" cellspacing="0" border="0" align="center" width="100%" style="max-width: 600px; margin: 0 auto;">
        <tr>
            <td align="center" valign="top" style="padding-top: 40px; padding-bottom: 40px;">
                <img src="{{ $message->embed(public_path() . '/images/landing-page-image.png') }}" alt="img" style="display: block; margin: 0 auto; max-width: 100%; height: auto;">
            </td>
        </tr>
        <tr>
            <td align="center" valign="top" style=" padding: 40px;">
                <h1 style="font-weight: bold; font-size: 25px; margin: 0 0 20px 0; line-height: 1.2; color: #333333; text-align: center;">{{__('email-verify.title')}}</h1>
                <p style="font-size: 18px; margin: 0 0 20px 0; line-height: 1.5; color: #666666; text-align: center;">{{__('email-verify.verify')}}</p>
                <table cellpadding="0" cellspacing="0" border="0" align="center" style="text-align: center;">
                    <tr>
                        <td align="center" valign="middle" style="background-color: #0fba68; padding: 12px 20px; border-radius: 8px; width: 392px;">
                            <a href="{{route('register.emailverified',[$token])}}" style="display: inline-block; font-weight: bold; font-size: 16px; color: #ffffff; text-decoration: none; width: 100%;">{{__('email-verify.verify')}}</a>
                        </td>                        
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
