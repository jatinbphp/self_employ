<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
    <title>Pet lagoon Email Template</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style type="text/css">
        table {
            border-collapse: collapse !important;
            padding: 0px !important;
            border: none !important;
            border-bottom-width: 0px !important;
            mso-table-l space: 0pt;
            mso-table-rspace: 0pt;
        }

        table td {
            border-collapse: collapse;
            text-decoration: none;
        }

        body {
            margin: 0px;
            padding: 0px;
            background-color: #e6e6e6;
        }

        .ExternalClass * {
            line-height: 100%;
        }

        @media only screen and (max-width:640px) {
            body {
                width: auto !important;
            }

            table [class=main] {
                width: 85% !important;
            }

            table [class=full] {
                width: 100% !important;
                margin: 0px auto;
            }

            table [class=table-inner] {
                width: 90% !important;
                margin: 0px auto;
            }

            td[class="table-merge"] {
                display: block;
                width: 100% !important;
            }

            img[class="image-full"] {
                width: 100% !important;
            }
        }

        @media only screen and (max-width:479px) {
            body {
                width: auto !important;
            }

            table [class=main] {
                width: 93% !important;
            }

            table [class=full] {
                width: 100% !important;
                margin: 0px auto;
            }

            td[class="table-merge"] {
                display: block;
                width: 100% !important;
            }

            table [class=table-inner] {
                width: 90% !important;
                margin: 0px auto;
            }

            img[class="image-full"] {
                width: 100% !important;
            }
        }
    </style>

</head>

<body>

    <!--Main Table Start-->
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" valign="top">

                <!--Header Part Start-->
                <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td align="center" valign="top">
                            <table width="800" border="0" align="center" cellpadding="0" cellspacing="0"
                                class="main">
                                <tr>
                                    <td align="center" valign="top" bgcolor="#fff">
                                        <table width="600" border="0" align="center" cellpadding="0"
                                            cellspacing="0" class="table-inner">
                                            <tr>
                                                <td height="6" colspan="2" align="left" valign="top"
                                                    style="font-size:20px; line-height:20px;">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td width="400" align="left" valign="top" class="table-merge">
                                                    <table border="0" align="left" cellpadding="0" cellspacing="0"
                                                        class="full">
                                                        <tr>
                                                            <td align="center" valign="top"
                                                                style="font-family: 'Inter', sans-serif; font-size:14px; font-weight:normal; color:#FFF;">
                                                                <img src="https://labssol.com/dev/selfemployee/SelfEmployee/public/assets/images/logo2.png"
                                                                    height="100">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td width="400" align="left" valign="middle" class="table-merge">
                                                    <table width="200" border="0" align="right" cellpadding="0"
                                                        cellspacing="0" class="full">
                                                        <tr>
                                                            <td align="left" valign="middle"
                                                                style="font-family: 'Inter', sans-serif; font-size:16px; font-weight:500; color:#000;">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="font-size:20px; line-height:20px;"
                                                    valign="top" height="6" align="left">&nbsp;</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <!--Header Part End-->

                <!--Banner Part Start-->
                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td align="center" valign="top">
                            <table width="800" border="0" align="center" cellpadding="0" cellspacing="0"
                                class="main">

                            </table>
                        </td>
                    </tr>
                </table>
                <!--Banner Part End-->

                <!--Content Part Start-->
                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td align="center" valign="top">
                            <table width="800" border="0" align="center" cellpadding="0" cellspacing="0"
                                class="main">
                                <tr>
                                    <td align="center" valign="top" bgcolor="#fff">
                                        <table width="600" border="0" align="center" cellpadding="0"
                                            cellspacing="0" class="table-inner">
                                            <tr>
                                                <td height="60" align="center" valign="middle"
                                                    style="font-size:60px; line-height:60px;">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td align="center" valign="middle">
                                                    <table width="100%" border="0" align="center"
                                                        cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td align="left" valign="top"
                                                                style="font-family: 'Inter', sans-serif; font-size:16px; font-weight:normal; color:#222; line-height:26px;">
                                                                Dear  {{ $data->email }}<br><br>
                                                                Thank you!
                                                                <br><br>
                                                                Please click below link to change your password! <br><br>
                                                                <br><br>
                                                                <a href="{!! $data->route !!}" target="_blank">{!! $data->route !!}</a>
                                                                <br><br>

                                                                <strong>Kind Regards</strong><br>
                                                                <strong>Self Employee Support Team</strong>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <div style="height:50px"></div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <!--Content Part End-->

                <!--Copyrights Part Start-->
                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td align="center" valign="top">
                            <table width="800" border="0" align="center" cellpadding="0" cellspacing="0"
                                class="main">
                                <tr>
                                    <td align="center" valign="top" bgcolor="#f6921f"
                                        style="-moz-border-radius:0px 0px 4px 4px; border-radius:0px 0px 4px 4px;">
                                        <table width="600" border="0" align="center" cellpadding="0"
                                            cellspacing="0" class="table-inner">
                                            <tr>
                                                <td height="25" colspan="3" align="center" valign="top"
                                                    style="line-height:25px; font-size:25px;">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td width="" align="left" valign="top"
                                                    style="font-family: 'Inter', sans-serif; font-size:14px; font-weight:normal; color:#fff;"
                                                    class="table-merge"> © <?= date('Y'); ?> Self Employee. All rights
                                                    reserved.
                                                </td>
                                                <!-- <td width="55" align="right" valign="top" style="font-family: 'Inter', sans-serif; font-size:14px; font-weight:bold; color:#FFF;" class="table-merge">&nbsp;</td>
                                          <td width="245" align="left" valign="top" style="font-family: 'Inter', sans-serif; font-size:14px; font-weight:normal; color:#FFF;" class="table-merge"><a href="#" style="color:#FFF; text-decoration:none;">Forward</a> &nbsp;. &nbsp;&nbsp;Unsubscribe&nbsp;&nbsp; . &nbsp;<a href="#" style="color:#FFF; text-decoration:none;">Support</a></td> -->
                                            </tr>
                                            <tr>
                                                <td height="25" colspan="3" align="center" valign="top"
                                                    style="line-height:25px; font-size:25px;">&nbsp;</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <!--Copyrights Part End-->
            </td>
        </tr>
    </table>
    <!--Main Table End-->
</body>

</html>
