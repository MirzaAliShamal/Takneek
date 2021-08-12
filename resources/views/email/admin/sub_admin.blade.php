<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0;">
    <meta name="format-detection" content="telephone=no"/>
    <style>
    body { margin: 0; padding: 0; min-width: 100%; width: 100% !important; height: 100% !important;}
    body, table, td, div, p, a { -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%; }
    table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; border-collapse: collapse !important; border-spacing: 0; }
    img { border: 0; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; }
    #outlook a { padding: 0; }
    .ReadMsgBody { width: 100%; } .ExternalClass { width: 100%; }
    .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }
    @media all and (min-width: 560px) {
    .container { border-radius: 8px; -webkit-border-radius: 8px; -moz-border-radius: 8px; -khtml-border-radius: 8px; }
    }
    a, a:hover {
    color: #FFFFFF;
    }
    .footer a, .footer a:hover {
    color: #828999;
    }
    </style>
    <title>User Email Verification</title>
  </head>
  <body topmargin="0" rightmargin="0" bottommargin="0" leftmargin="0" marginwidth="0" marginheight="0" width="100%" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%; height: 100%; -webkit-font-smoothing: antialiased; text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; line-height: 100%;">
    <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; width: 100%;" class="background"><tr><td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;">
      <table border="0" cellpadding="0" cellspacing="0" align="center"
        width="500" style="border-collapse: collapse; border-spacing: 0; padding: 0; width: inherit;
        max-width: 500px;" class="wrapper">
        <tr>
          <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
            padding-top: 20px;
            padding-bottom: 20px;">

            <a target="_blank" style="text-decoration: none;"
              href="">{{ env('APP_NAME') }}</a>
          </td>
        </tr>
        <tr>
          <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0;  padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 24px; font-weight: bold; line-height: 130%;
            padding-top: 5px;
            font-family: sans-serif;" class="header">
            Welcome to {{ env('APP_NAME') }}!
          </td>
        </tr>
        <tr>
          <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
            padding-top: 24px;" class="line"><hr
            color="#565F73" align="center" width="100%" size="1" noshade style="margin: 0; padding: 0;" />
          </td>
        </tr>

        <!------------------------------------------------------------------------->
                            <!--ENGLISH Email content--->
        <!------------------------------------------------------------------------->


        <tr>
          <td align="left" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 17px; font-weight: 400; line-height: 160%;
            padding-top: 15px;
            font-family: sans-serif; font-style: italic;" class="paragraph">
            Dear Member,
          </td>
        </tr>
        
        <tr>
          <td align="left" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 17px; font-weight: 400; line-height: 160%;
            padding-top: 10px;
            font-family: sans-serif; justify-content: center;" class="paragraph">
            
            Your profile has been created at our platform. Below are your details to get login to dashboard.
          </td>
        </tr>

        <tr>
          <td align="left" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 17px; font-weight: 400; line-height: 160%;
                padding-top: 30px;
                color: #000;
                font-family: sans-serif; justify-content: center;" class="paragraph">

                <div style="padding-bottom: 5px;">Name: <strong style="color: #bbb;font-size: 18px;">{{$data['name'] ?? 'N / A'}}</strong></div>
                <div style="padding-bottom: 5px;">Email: <strong style="color: #bbb;font-size: 18px;">{{$data['email'] ?? 'N / A'}}</strong></div>
                <div style="padding-bottom: 5px;">Password: <strong style="color: #bbb;font-size: 18px;">{{$data['password'] ?? 'N / A'}}</strong></div>

              </td>
          </tr>


        <tr>
          <td align="left" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 15px; font-weight: 400; line-height: 160%;
            padding-top: 15px;
            color: #000;
            font-family: sans-serif;" class="paragraph">
            Thanks<br/>

          </td>
        </tr>

        <!------------------------------------------------------------------------->
                            <!--END ENGLISH Email content--->
        <!------------------------------------------------------------------------->
         

        

        <tr>
            <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%;
                padding-top: 30px;" class="line"><hr
                color="#565F73" align="center" width="100%" size="1" noshade style="margin: 0; padding: 0;" />
            </td>
        </tr>
        <tr>
            <td align="center" valign="top" style="border-collapse: collapse; border-spacing: 0; margin: 0; padding: 0; padding-left: 6.25%; padding-right: 6.25%; width: 87.5%; font-size: 13px; font-weight: 400; line-height: 150%;
                padding-top: 10px;
                padding-bottom: 20px;
                color: #828999;
                font-family: sans-serif;" class="footer">
                This email was sent to&nbsp;you because you&nbsp;have used&nbsp;our &nbsp;platform.<br/>
                © Copyright 2021 by {{ env('APP_NAME') }}. All Right Reserved.
            </td>
        </tr>
      </table>
    </td></tr></table>
  </body>
</html>
