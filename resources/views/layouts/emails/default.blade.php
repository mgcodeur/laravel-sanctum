{{--<a href="{{$user->generateVerificationLink()}}">Verifier l'utilisateur</a>--}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{--  TODO: rendre cette partie dynamique  --}}
    <link rel="icon" href="images/favicon.png" type="image/x-icon">

    <title>{{ $title ?? env('APP_NAME') }}</title>


    @stack('css')
</head>

<body style="margin: 20px auto;">
<table align="center"
       border="0"
       cellpadding="0"
       cellspacing="0"
       style="background-color: white;
           width: 100%;
           box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);
           -webkit-box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);"
>
    <tbody>
    <tr>
        <td style="padding: 25px;">
            <table align="center"
                   border="0"
                   cellpadding="0"
                   cellspacing="0"
                   width="100%"
            >
                <tbody>
                    <tr class="header">
                        <td align="left" valign="top">
                            <a href="#">
                                <!--Logo here-->
                                @yield('logo')
                            </a>
                        </td>
                        <td class="menu" align="right">
                            {{-- TODO: rendre cette section dynamique --}}
                            <ul>
                                <li style="display: inline-block;text-decoration: unset">
                                    <a href="#" style="text-transform: capitalize;color:#444;font-size:16px;margin-right:15px;text-decoration: none;">Accueil</a>
                                </li>
                                <li style="display: inline-block;text-decoration: unset">
                                    <a href="#" style="text-transform: capitalize;color:#444;font-size:16px;margin-right:15px;text-decoration: none;">Favoris</a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>

<table align="center"
       border="0"
       cellpadding="0"
       cellspacing="0"
       style="background-color: white; width: 100%; padding: 0 30px; box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);"
>
    <tbody>
    <tr>
        <td class="welcome-image mb-3" style="display: block;">
            {{-- image banner here --}}
            {{--<img src="#" style="width: 100%; margin-top: 20px;" alt="Panera Logo">--}}
        </td>

        <td class="welcome-name mb-3" style="text-align: left; display: block;">
            <h4 style="text-transform: capitalize; margin: 0; font-weight: 500; color: #232323">
                @yield('greeting')
            </h4>

            @yield('main-content')
        </td>

        <td class="verify-button mb-3" style="display: block;">
            @yield('verification-button')
        </td>

        <td class="welcome-details mb-3" style="display: block;">
            @yield('additional-content')
        </td>
    </tr>
    </tbody>
</table>

<table class="text-center" align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
       style="background-color: #eff2f7; color: #232323; padding: 40px 30px;">
    <tr>
        <td>
            <table border="0" cellpadding="0" cellspacing="0" class="footer-social-icon text-center" align="center"
                   style="margin: 8px auto 20px;">
                {{--TODO: rendre cette section dynamique--}}
                {{--<tr>
                    <td>
                        <a href="javascript:void(0)">
                            <img src="images/fb.png" alt=""
                                 style="font-size: 25px; margin: 0 18px 0 0;width: 22px;">
                        </a>
                    </td>
                    <td>
                        <a href="javascript:void(0)">
                            <img src="images/twitter.png" alt=""
                                 style="font-size: 25px; margin: 0 18px 0 0;width: 22px;">
                        </a>
                    </td>
                    <td>
                        <a href="javascript:void(0)">
                            <img src="images/insta.png" alt=""
                                 style="font-size: 25px; margin: 0 18px 0 0;width: 22px;">
                        </a>
                    </td>
                    <td>
                        <a href="javascript:void(0)">
                            <img src="images/google-plus.png" alt="" style="font-size: 25px; width: 22px;">
                        </a>
                    </td>
                </tr>--}}
            </table>
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <ul class="how-work">
                        <li style="margin-left: 0;">Contact us</li>
                        <li>How it works</li>
                        <li>FAQs</li>
                        <li style="margin-right: 0;">T&Cs</li>
                    </ul>
                </tr>
                {{--TODO: rendre cette section dynamique--}}
                {{--<tr class="footer-details">
                    <p  style="margin: 10px auto 0;
                            font-size: 14px;
                            width: 80%;
                            color: #7e7e7e;"
                    >
                        Yor Have received
                        this email as a registered user of
                        <a style="color: #00639e; text-decoration: underline; font-weight: 700;"
                           href="#"
                        >
                            PaneraMg
                        </a>
                        You can
                        <a style="color: #00639e; text-decoration: underline; font-weight: 700;" href="javascript:void(0)">Unsubscribe</a>
                        from these emails here(Don't worry. take it personally).
                    </p>
                </tr>--}}
            </table>
        </td>
    </tr>
</table>
</body>
</html>
