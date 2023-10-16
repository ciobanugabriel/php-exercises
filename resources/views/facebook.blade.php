<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Twitter Wall Posts</title>
</head>
<body class="bg-gray-100 font-sans">


<div class="container mx-auto p-4">

    <button class="bg-blue-500 text-white rounded-md p-2 mb-1 mr-1">Add</button>
    <table class="w-full bg-white shadow-lg rounded-lg overflow-hidden">
        <tbody>
        <!-- Sample Wall Post 1 -->
        <tr>
            <td class="p-4">
                <div class="flex items-center">
                    <img src="https://placekitten.com/50/50" alt="User" class="w-10 h-10 rounded-full">
                    <div class="ml-4">
                        <div class="text-gray-800 font-semibold">John Doe</div>
                        <div class="text-gray-600">2 hours ago</div>
                    </div>
                </div>
                <p class="mt-2 text-gray-700">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut perspiciatis unde omnis iste natus.
                </p>
                <img src="https://placekitten.com/600/400" alt="Post Image" class="mt-4 rounded-lg shadow-md">
            </td>
        </tr>


        </tbody>
    </table>
</div>

</body>
</html>
