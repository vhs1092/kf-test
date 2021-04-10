<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>{{config('app.name')}} - Notification</title>

    <style>
        * {
            font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
            font-size: 100%;
            line-height: 1.6em;
            margin: 0;
            padding: 0;
        }

        body {
            -webkit-font-smoothing: antialiased;
            height: 100%;
            -webkit-text-size-adjust: none;
            width: 100% !important;
        }

        a {
            color: #348eda;
        }

        .btn-primary {
            Margin-bottom: 10px;
            width: auto !important;
        }

        .btn-primary td {
            background-color: #62cb31;
            border-radius: 3px;
            font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
            font-size: 14px;
            text-align: center;
            vertical-align: top;
        }

        .btn-primary td a {
            background-color: #62cb31;
            border: solid 1px #62cb31;
            border-radius: 3px;
            border-width: 4px 20px;
            display: inline-block;
            color: #ffffff;
            cursor: pointer;
            font-weight: bold;
            line-height: 2;
            text-decoration: none;
        }

        .last {
            margin-bottom: 0;
        }

        .first {
            margin-top: 0;
        }

        .padding {
            padding: 10px 0;
        }

        table.body-wrap {
            padding: 20px;
            width: 100%;
        }

        table.body-wrap .container {
            border: 1px solid #e4e5e7;
        }

        table.footer-wrap {
            clear: both !important;
            width: 100%;
        }

        .footer-wrap .container p {
            color: #666666;
            font-size: 12px;

        }

        table.footer-wrap a {
            color: #999999;
        }

        h1,
        h2,
        h3 {
            color: #111111;
            font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
            font-weight: 200;
            line-height: 1.2em;
            margin: 40px 0 10px;
        }

        h1 {
            font-size: 36px;
        }
        h2 {
            font-size: 28px;
        }
        h3 {
            font-size: 22px;
        }

        p,
        ul,
        ol {
            font-size: 14px;
            font-weight: normal;
            margin-bottom: 10px;
        }

        ul li,
        ol li {
            margin-left: 5px;
            list-style-position: inside;
        }

        blockquote{
            display:block;
            background: #fff;
            padding: 15px 20px 15px 45px;
            margin: 0 0 20px;
            position: relative;

            /*Font*/
            font-family: Georgia, serif;
            font-size: 16px;
            line-height: 1.2;
            color: #666;
            text-align: justify;

            /*Borders - (Optional)*/
            border-left: 15px solid #37a9b5;
            border-right: 2px solid #013F82;

            /*Box Shadow - (Optional)*/
            -moz-box-shadow: 2px 2px 15px #ccc;
            -webkit-box-shadow: 2px 2px 15px #ccc;
            box-shadow: 2px 2px 15px #ccc;
        }

        blockquote::before{
            content: "\201C"; /*Unicode for Left Double Quote*/
            /*Font*/
            font-family: Georgia, serif;
            font-size: 60px;
            font-weight: bold;
            color: #999;

            /*Positioning*/
            position: absolute;
            left: 10px;
            top:5px;
        }

        blockquote::after{
            /*Reset to make sure*/
            content: "";
        }

        blockquote a{
            text-decoration: none;
            background: #eee;
            cursor: pointer;
            padding: 0 3px;
            color: #0067B6;
        }

        blockquote a:hover{
            color: #666;
        }

        blockquote em{
            font-style: italic;
        }

        /* ---------------------------------------------------
            RESPONSIVENESS
        ------------------------------------------------------ */

        /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
        .container {
            clear: both !important;
            display: block !important;
            Margin: 0 auto !important;
            max-width: 600px !important;
        }

        /* Set the padding on the td rather than the div for Outlook compatibility */
        .body-wrap .container {
            padding: 40px;
        }

        /* This should also be a block element, so that it will fill 100% of the .container */
        .content {
            display: block;
            margin: 0 auto;
            max-width: 600px;
        }

        /* Let's make sure tables in the content area are 100% wide */
        .content table {
            width: 100%;
        }


        /* unvisited link */
        a:link {
            color: #000;
            text-decoration: none;
        }

        /* visited link */
        a:visited {
            color: #000;
        }

        /* mouse over link */
        a:hover {
            color: #000;
        }

        /* selected link */
        a:active {
            color: #000;
        }


        .button {
            display: inline-block;
            -webkit-box-sizing: content-box;
            -moz-box-sizing: content-box;
            box-sizing: content-box;
            cursor: pointer;
            padding: 6px 20px 6px 53px;
            border: none;
            -webkit-border-radius: 2px;
            border-radius: 2px;
            font: normal 18px/normal "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;;
            color:#000;
            -o-text-overflow: clip;
            text-overflow: clip;
background: url("\Storage::disk('s3')->url('icons/attachment16.png')"), rgb(192,192,192);
            background-repeat: no-repeat;
            background-position: 14px 50%;

            }

    </style>
</head>

<body bgcolor="#f7f9fa">


<table class="body-wrap" bgcolor="#f7f9fa">
    <tr>
        <td></td>
        <td class="container" bgcolor="#FFFFFF">
            <hr style="background-color: #01b1c0; height:2px; border:0px;">
            <div class="content">
                <table>
                    <tr>
                        <td>
                            <p>@yield('em-body')</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center;"><br/>
                            <img alt="logo Kickfurther" src="https://www.kickfurther.com/images/homepage/kf-logo.png"/>
                        </td>
                    </tr>
                    <tr>
                        <td><p style="text-align:center;font-style:italic;font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;
                                                font-size: 12px;">This is a notification-only email address. Please do
                                not reply to this message.</p></td>
                    </tr>
                </table>


            </div>

        </td>
        <td></td>
    </tr>
</table>




<table class="footer-wrap">
    <tr>
        <td></td>
        <td class="container">

            <div class="content">
                <table>
                    <tr>
                        <td align="center">

                        </td>
                    </tr>
                </table>
            </div>

        </td>
        <td></td>
    </tr>
</table>

</body>
</html>

