<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>مكتبة الكلمات</title>


    <!-- Bootstrap core CSS -->

    <script src="http://demo.expertphp.in/js/jquery.js"></script>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('public/images/favicon.ico')}}" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="{{asset('public/fonts/fontawesome/css/fontawesome-all.min.css')}}">
    <!-- animation css -->
    <link rel="stylesheet" href="{{asset('public/plugins/animation/css/animate.min.css')}}">
    <!-- vendor css -->
    <link rel="stylesheet" href="{{asset('public/css/style.css')}}">
    <!-- rtl layouts -->
    <link rel="stylesheet" href="{{asset('public/css/layouts/rtl.css')}}">
    <!-- data tables css -->
    <link rel="stylesheet" href="{{asset('public/plugins/data-tables/css/datatables.min.css')}}">

    <link rel="stylesheet" href="{{asset('public/fonts/material/css/materialdesignicons.min.css')}}">

    <link href="{{asset('public/plugins/jstree/css/style.min.css')}}" rel="stylesheet">

    <link href="{{asset('public/plugins/nestable-master/css/nestable.min.css')}}" rel="stylesheet">
    <style>
        .unread {
            background-color: #cfdae3
        }

        .noti-body {

            overflow-y: scroll;
            overflow-x: hidden;
        }

        #items {
            list-style: none;
            margin: 0px;
            margin-top: 4px;
            padding-left: 10px;
            padding-right: 10px;
            padding-bottom: 3px;
            font-size: 17px;
            color: #333333;

        }

        hr {
            width: 85%;
            background-color: #E4E4E4;
            border-color: #E4E4E4;
            color: #E4E4E4;
        }

        #cntnr {
            display: none;
            position: absolute;
            border: 1px solid #B2B2B2;
            width: 117px;
            background: #F9F9F9;
            box-shadow: 3px 3px 2px #E9E9E9;
            border-radius: 4px;
        }


        /*li {*/

            /*padding: 3px;*/
            /*padding-left: 10px;*/
        /*}*/

        #items :hover {
            color: white;
            background: #284570;
            border-radius: 2px;

        }
        #asd{
            font-size: 20px !important;
        }
        #asd p{
            font-size: 20px !important;
        }

    </style>
    @yield('css')
</head>

<body>