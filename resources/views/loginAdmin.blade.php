<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin</title>

    <!-- Tailwind CSS CDN (gunakan ini jika belum punya mix('css/main.css')) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="flex justify-center items-center h-screen bg-gray-200 px-6">
        <div class="p-6 max-w-sm w-full bg-white shadow-md rounded-md">
            <div class="flex justify-center items-center mb-4">
                <img class="size-9" src="\img\jemberlogo.png" alt="Your Company">
                <path
                    d="M364.61 390.213C304.625 450.196 207.37 450.196 147.386 390.213C117.394 360.22 102.398 320.911 102.398 281.6C102.398 242.291 117.394 202.981 147.386 172.989C147.386 230.4 153.6 281.6 230.4 307.2C230.4 256 256 102.4 294.4 76.7999C320 128 334.618 142.997 364.608 172.989C394.601 202.981 409.597 242.291 409.597 281.6C409.597 320.911 394.601 360.22 364.61 390.213Z"
                    fill="#4C51BF" stroke="#4C51BF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path
                    d="M201.694 387.105C231.686 417.098 280.312 417.098 310.305 387.105C325.301 372.109 332.8 352.456 332.8 332.8C332.8 313.144 325.301 293.491 310.305 278.495C295.309 263.498 288 256 275.2 230.4C256 243.2 243.201 320 243.201 345.6C201.694 345.6 179.2 332.8 179.2 332.8C179.2 352.456 186.698 372.109 201.694 387.105Z"
                    fill="white" />
                </svg>
                <span class="text-gray-700 font-semibold text-2xl ml-2">Admin Login</span>
            </div>

            <!-- Error message -->
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <strong class="font-bold">Oops!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <label class="block mb-3">
                    <span class="text-gray-700 text-sm">Email</span>
                    <input type="email" name="email" id="email" required autofocus
                        class="form-input mt-1 block w-full rounded-md focus:border-indigo-600">
                </label>

                <label class="block mb-3">
                    <span class="text-gray-700 text-sm">Password</span>
                    <input type="password" name="password" id="password" required
                        class="form-input mt-1 block w-full rounded-md focus:border-indigo-600">
                </label>

                <div class="flex justify-between items-center mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="form-checkbox text-indigo-600">
                        <span class="ml-2 text-gray-600 text-sm">Remember me</span>
                    </label>
                </div>

                <button type="submit"
                    class="py-2 px-4 bg-indigo-600 rounded-md w-full text-white text-sm hover:bg-indigo-500">
                    Sign in
                </button>
            </form>
        </div>
    </div>
</body>

</html>
