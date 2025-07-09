<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Swippy Administration Login</title>

    {{-- Font Awesome for icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Toastr CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="{{ asset('assets/images/icons/favicon.ico') }}" type="image/x-icon">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #00bfae, #0f172a);
            animation: gradientMove 10s ease infinite;
        }

        @keyframes gradientMove {
            0% { background: linear-gradient(135deg, rgb(23 183 113), rgb(255, 255, 255)); }
            50% { background: linear-gradient(135deg, rgb(23 183 113), rgb(255, 255, 255)); }
            100% { background: linear-gradient(135deg, rgb(23 183 113), rgb(255, 255, 255)); }
        }

        .split-form {
            display: flex;
            background: white;
            border-radius: 20px;
            overflow: hidden;
            width: 100%;
            max-width: 900px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .image-side {
            flex: 1;
            background: linear-gradient(135deg, #00ff90, #0f172a);
            color: white;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            box-shadow: inset 0px 0px 100px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
        }

        .image-side h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            animation: slideIn 0.8s ease-out;
        }

        @keyframes slideIn {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .form-side {
            flex: 1;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-side h2 {
            color: #0f172a;
            margin-bottom: 2rem;
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            transition: color 0.3s ease;
        }

        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
            transition: transform 0.2s ease;
        }

        .input-group input {
            width: 100%;
            padding: 1rem;
            padding-right: 3rem;
            border: none;
            border-bottom: 2px solid #ccc;
            background: transparent;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .input-group input:focus {
            border-bottom-color: #00ff90;
            outline: none;
            transform: scale(1.05);
        }

        .input-group .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #888;
            transition: color 0.3s ease;
        }

        .input-group input:focus + .toggle-password {
            color: #00ff90;
        }

        .form-side button {
            width: 100%;
            padding: 1rem;
            background: #00ff90;
            color: #ffffff;
            font-weight: bold;
            border: none;
            border-radius: 30px;
            font-size: 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: transform 0.2s, background 0.3s ease;
        }

        .form-side button:hover {
            transform: translateY(-2px);
            background: #00bfae;
        }

        .form-side button:active {
            transform: translateY(2px);
        }

        ::placeholder {
            color: #999;
        }
    </style>
</head>
<body>

    <div class="split-form">
        <div class="image-side">
            <h2> <i class="fas fa-bolt" style="color: #00ff90;"></i> Welcome to Swippy</h2>
            <p><i class="fas fa-file" style="color: #00ff90;"></i> Manage your store efficiently with Swippy Admin Panel.</p>
        </div>
        <div class="form-side">
            <h2 class="bi bi-shield-lock me-1"> Administration Login</h2>
            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <div class="input-group">
                    <input type="email" value="{{old('email')}}" name="email" placeholder="Email">
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Password" id="password">
                    <i class="fa-solid fa-eye toggle-password" id="togglePassword"></i>
                </div>
                <button type="submit">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i> Login
                </button>
            </form>
        </div>
    </div>

    {{-- Toastr Notifications --}}
    <script>
        @if($errors->any())
            toastr.error("{{ $errors->first() }}", 'Error', {
                closeButton: true,
                progressBar: true
            });
        @endif

        @if(session('status'))
            toastr.success("{{ session('status') }}", 'Success', {
                closeButton: true,
                progressBar: true
            });
        @endif
    </script>

    {{-- Password toggle --}}
    <script>
        $('#togglePassword').on('click', function () {
            const passwordInput = $('#password');
            const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
            passwordInput.attr('type', type);
            $(this).toggleClass('fa-eye fa-eye-slash');
        });
    </script>

</body>
</html>
