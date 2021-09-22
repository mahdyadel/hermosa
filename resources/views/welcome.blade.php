<!doctype html>
<html dir="{{ app()->getLocale() == 'ar' ? 'ltr' : 'rtl' }}">
    <head>
        <title>Hermosa</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
         <style>
            html, body {
                margin: 0;
                width: 100%;
                /* overflow-x: hidden; */
            }
            .container-bg {
                width: 100%;
                height: 100vh;
                display: flex;
            }
            .col-bg {
                width: 33.3%;
            }
            div.box {
                width: 100%;
                height: 100vh;
                background-color: #FEF3F9;
            }
            .box:after {
                content: ' ';
                border-top: 100vh solid #fff;
                border-right: 33vw solid transparent;
                width: 0;
                position: absolute;
                left: 0;
            }


            .container-bg-2 {
                width: 100%;
                height: 100vh;
                display: flex;
            }
            .col-bg-2 {
                width: 50%;
            }
            div.box-2 {
                width: 100%;
                height: 100vh;
                background-color: #fff;
            }
            .box-2:after {
                content: ' ';
                border-top: 100vh solid #E99CC8;
                border-right: 85vw solid transparent;
                width: 0;
                position: absolute;
                left: 0;
            }

            .container-custom {
                padding: 0;
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100vh;
            }
            .row {
                margin:0;
            }
            
            .logo {
                width: 70px;
                height: 80px;;
            }

            .custom-row-2 {
                display: flex;
                justify-content: center;
                align-items: center;
                height: calc(100vh - 80px);
            }

            .video-container {
                display: flex;
                justify-content: center;
                align-items: center;
            }
            
            .video {
                background: #fef3f9;
                border-radius: 20px;
                width: 400px;
                height: 300px;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .reservation-now-container, .reservation-now {
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
            }

            .reservation-now h3 {
                font-size:30px;
                font-weight: 600;
                color: rgb(227,11,139);
            }

            .reservation-now p {
                color: #707070;
            }

            .description {
                text-align: right;
                padding: 30px 50px;
            }
            .header-contact-info {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .header-menu-container {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .header-menu {
                display: flex;
                justify-content: space-between;
                list-style: none;
                padding: 0;
                margin: 0;
            }

            ul.header-menu li {
                margin: 10px;
            }

            .our-services {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
            }

            .our-services ul {
                background: white;
                width: 700px;
                float: left;
                margin: 100px;
                border-radius: 30px;
                display: flex;
                justify-content: space-around;
                flex-wrap: wrap;
                flex-grow: 3;
                padding: 20px;
                box-shadow: 0 1px 3px 0 #b7b8b9;
            }

            .our-services ul li {
                display: flex;
                flex-direction: column;
                border-left: 1px solid #919191;
                padding-left: 20px;
                text-align: center;
                margin: 20px;
                margin-right: 0;
            }

            .our-services ul li:nth-child(3n) {
                border: 0;
                margin-left: 0;
                padding-left: 0;
            }
        </style>
    </head>
    <body>
        <div class="container-bg">
            <div class="col-bg" style="background: #fef3f9;">
            </div>

            <div class="col-bg" style="position: relative">
                <div class="box"></div>
            </div>

            <div class="col-bg">
            </div>

        </div>

        <div class="container container-custom">
            <div class="row">
                <div class="col-1">
                    <div class="logo">
                        <a href="/">
                            <img src="/images/logo.png" width="100%" height="100%" />
                        </a>
                    </div>
                </div>
                <div class="col-6 header-contact-info">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-4">
                                Choose an address
                            </div>
                            <div class="col-4">
                                +2001030365770
                            </div>
                            <div class="col-4">
                                email@gmail.com
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-5 header-menu-container">
                    <ul class="header-menu">
                        <li>الخدمات</li>
                        <li>شرح التطبيق</li>
                        <li>تحميل</li>
                        <li>خدمات منزلية</li>
                        <li>انضم لنا</li>
                    </ul>
                </div>
            </div>

            <div class="row custom-row-2">
                <div class="col-6">
                    <div class="description">
                        <h3>نص تجريبي</h3>
                        <p>هذا النص هو مثال لنص يمكن ان يستبدل في نفس المساحة لقد تم توليد هذا النص من مولد النص العربي حيث يمكنك ان تولد مثل هذا النص او العديد من النصوص الاخري</p>
                    </div>
                </div>
                <div class="col-6 video-container">
                    <div class="video">
                        <i>icon</i>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-bg-2" style="position: relative">
            <div class="box-2"></div>

            <div class="our-services">
            <div style="
    float: right;
">
        <img src="/images/landing.png">
    </div>
    
                <ul>
                    <li>
                        <i>icon</i>
                        <h5>Service Name</h5>
                        <p>Service Description</p>
                    </li>
                    <li>
                        <i>icon</i>
                        <h5>Service Name</h5>
                        <p>Service Description</p>
                    </li>
                    <li>
                        <i>icon</i>
                        <h5>Service Name</h5>
                        <p>Service Description</p>
                    </li>
                    <li>
                        <i>icon</i>
                        <h5>Service Name</h5>
                        <p>Service Description</p>
                    </li>
                    <li>
                        <i>icon</i>
                        <h5>Service Name</h5>
                        <p>Service Description</p>
                    </li>
                    <li>
                        <i>icon</i>
                        <h5>Service Name</h5>
                        <p>Service Description</p>
                    </li>
                </ul>
            </div>
        </div>

        <div class="container-fluid reservation-now-container">
            <div class="reservation-now">
                <h3>احجز صالون الآن</h3>
                <p>هذا النص هو مثال لنص يمكن ان يستبدل في نفس المساحة لقد تم توليد هذا النص من مولد النص العربي حيث يمكنك ان تولد مثل هذا النص او العديد من النصوص الاخري</p>
            </div>

            <div class="row">
                <div class="col-6">
                    app store
                </div>

                <div class="col-6">
                    google play
                </div>
            </div>
        </div>
    </body>
</html>
