
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-l from-black to-cyan-400 flex justify-center items-center">
<p>

</p>

<div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700 mt-20">
    <form class="space-y-6" method="post" action="{{ route('login') }}">
        @csrf <!-- {{ csrf_field() }} -->
        <h5 class="text-xl font-medium text-gray-900 dark:text-white">Sign in</h5>
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="hopa_mitica" required>
        </div>
        <div>
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
        </div>
        <div name="errorMessage" class="text-red-700">
            @if(isset($errorMessage))
                {{ $errorMessage }}
            @endif
        </div>
        <button type="submit" name="loginButton" class="w-full text-white bg-cyan-400 hover:bg-cyan-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-cyan-600 dark:hover:bg-cyan-400 dark:focus:ring-cyan-800">Login</button>
        <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
            Not registered? <a href="{{ route('show-create-account') }}" class="text-cyan-400 hover:underline dark:text-cyan-500">Create account</a>
        </div>
    </form>
</div>


</body>

</html>
