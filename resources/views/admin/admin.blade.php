<!DOCTYPE html>
<html>
<head>
    <title>Soesweet Bali</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/x-icon" href="{{asset('img/logo_color.png')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@200;300;400;500;600&family=Nunito:wght@700;800;900;1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Montserrat", sans-serif;
        }

        h1 {
            font-size: 1.65rem;
        }

        h2 {
            font-size: 1.55rem;
        }

        h3 {
            font-size: 1.45rem;
        }

        h4 {
            font-size: 1.35rem;
        }

        h5 {
            font-size: 1.25rem;
        }

        h6 {
            font-size: 1.15rem;
        }

        .row {
            --bs-gutter-x: 0 !important;
        }

        .content-wrapper {
            margin: 0 auto;
            padding: 20px;
            max-width: 1200px;
            background-color: #ffffff;
            border-radius: 10px;
        }

        .table img {
            width: 150px;
            height: 150px;
            display: block;
            margin: auto;
        }

        body {
            background-color: #f0f0f0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
        }

        footer {
            background-color: #ffffff;
            padding: 10px;
            text-align: center;
            border-top: 1px solid #ddd;
        }
    </style>
</head>

<body>
    @include('admin.partial.header')

    @if (@session('success'))
        <script>
            alert( "{{ session('success') }}" )
        </script>
    @endif

    <div class="main-content">
        <div class="content-wrapper mt-4 mb-4">

            @yield('content')

        </div>
    </div>

    @include('admin.partial.footer')

    <script src="{{ asset('js/jquery-1.11.0.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    {{-- PreviewImage --}}
    <script>
        const imageInput = document.getElementById('imageInput');
        const previewImage = document.getElementById('previewImage');

        imageInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    previewImage.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

    <script>
        const priceInput = document.getElementById('priceInput');
        const priceRaw = document.getElementById('priceRaw');

        priceInput.addEventListener('input', function (e) {
            // Remove dots for processing
            let rawValue = e.target.value.replace(/\./g, '');

            // Check if the input is a valid number
            if (!isNaN(rawValue) && rawValue !== '') {
                // Update the visible input with formatted value
                e.target.value = new Intl.NumberFormat('id-ID').format(rawValue);

                // Update the hidden input with raw integer value
                priceRaw.value = rawValue;
            } else if (rawValue === '') {
                // Clear both inputs if user deletes everything
                priceRaw.value = '';
            }
        });
    </script>

</body>
</html>
