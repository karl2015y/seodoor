<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$door->title}}</title>
    <meta name="description" content="{{$door->content}}">
    <!-- Google Tag Manager -->
    <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NSB7HL5');
    </script>
    <!-- End Google Tag Manager -->
    <script>
        window.onpageshow = function (event) {
            if (event.persisted) {
                if (location.href.indexOf("#") > -1) {
                    history.go(-2);
                }
            }
        };
        if (location.href.indexOf("#") > -1) {
            history.go(-2);
        }
    </script>
    <link rel="stylesheet" href="{{secure_asset('seodoor/css/reset.css')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="{{secure_asset('seodoor/css/googlefont.css')}}">
    <link rel="stylesheet" href="{{secure_asset('seodoor/css/animate.min.css')}}" />
    <link rel="stylesheet" href="{{secure_asset('seodoor/css/style.css')}}">



</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NSB7HL5" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div class="wrap" style="background-image: url('{{$door->pic}}');">
        <form style="display: none" id="goform" action="" method="post">
            @csrf
            {{-- type="hidden" style="display: none" --}}
            <input name="action" value="前往">
            <input name="lon" value="0">
            <input name="lat" value="0">
            <button type="submit"></button>
        </form>
    </div>
    <div class="modal">
        <a id="hidenlink" href="{{$door->to_link}}" style="display: none;">.</a>
        <div class="modal-content ">
            <a id="close" class="close-modal" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                關閉
            </a>

            <div class="content-pic-text">
                <div class="content-pic">
                    <img src="{{$door->pic}}" alt="{{$door->pic_name}}">
                </div>
                <div class="content-text">
                    <div>
                        <h1 style="white-space: pre-line;">{{$door->title}}</h1>
                        <p style="white-space: pre-line;">{{$door->content}}</p>

                        <a id="gogo" href="#">
                            立即前往 GO GO !
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <script src="{{secure_asset('seodoor/js/script.js')}}"></script>

</body>

</html>