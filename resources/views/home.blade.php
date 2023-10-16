<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-l from-black to-cyan-400">
<nav class="bg-cyan-900 p-4 fixed w-full top-0 z-10">
    <div class="container mx-auto flex justify-between items-center">
        @foreach($profilePictures as $profilePicture)
            @if($profilePicture->id === $user->profile_picture_id)
                <img src="{{ asset('storage/images/' . $profilePicture->name) }}" alt="Profile Picture" height="75"
                     width="75"
                     class="rounded-full">
                <div class="text-white">Welcome to the jungle, {{ $user->name }}!</div>
            @endif
        @endforeach

        <img src="{{ asset('/images/log-out.png') }}" class="opacity-50 hover:opacity-100"
             onclick="location.href='{{ route('logout') }}'" alt="Log out" width="48" height="48"/>
    </div>
</nav>

<!-- Add Modal  -->
<div id="add-modal" tabindex="-1"
     class="fixed flex items-center justify-center top-0 left-0 right-0 bottom-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    onclick="closeModalById('add-modal')">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-6 text-center">
                <img src="{{ asset('images/add.png') }}" class="mx-auto mb-4" onclick="" alt="Edit" width="48"
                     height="48"/>

                <form method="post" action="{{ route('store') }}" enctype="multipart/form-data">
                    @csrf <!-- {{ csrf_field() }} -->
                    <div class="mb-6">
                        <label for="addInputImage" class="flex mb-2 text-sm font-medium text-gray-900 dark:text-white">Image</label>
                        <input type="file" id="addInputImage" name="addInputImage" accept="image/*"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-cyan-500 dark:focus:border-cyan-500"
                               required>
                    </div>
                    <div class="mb-6">
                        <label for="addInputDescription"
                               class="flex mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <input type="text" id="addInputDescription" name="addInputDescription"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-cyan-500 dark:focus:border-cyan-500"
                               required>
                    </div>
                    <button type="submit" name="addButtonModal"
                            class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-greeb-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Post
                    </button>
                    <button type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                            onclick="closeModalById('add-modal')">Cancel
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Modal  -->
<div id="edit-modal" tabindex="-1"
     class="fixed flex items-center justify-center top-0 left-0 right-0 bottom-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    onclick="closeModalById('edit-modal')">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-6 text-center">
                <img src="{{ asset('images/edit.png') }}" class="mx-auto mb-4" onclick="" alt="Edit" width="48"
                     height="48"/>
                <form method="post" action="{{ route('edit') }}" enctype="multipart/form-data">
                    @csrf <!-- {{ csrf_field() }} -->
                    <input type="hidden" id="editInputPhotoID" name="editInputPhotoID">
                    <div class="mb-6">
                        <label for="editInputImage" class="flex mb-2 text-sm font-medium text-gray-900 dark:text-white">Image</label>
                        <input type="file" id="editInputImage" name="editInputImage" accept="image/*"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-cyan-500 dark:focus:border-cyan-500">
                    </div>
                    <div class="mb-6">
                        <label for="editInputDescription"
                               class="flex mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <input type="text" id="editInputDescription" name="editInputDescription"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-cyan-500 dark:focus:border-cyan-500"
                               required>
                    </div>
                    <button type="submit" name="editButtonModal"
                            class="text-white bg-yellow-600 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-greeb-300 dark:focus:ring-yellow-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Edit
                    </button>
                    <button type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                            onclick="closeModalById('edit-modal')">Cancel
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal  -->
<div id="delete-modal" tabindex="-1"
     class="fixed flex items-center justify-center top-0 left-0 right-0 bottom-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    onclick="closeModalById('delete-modal')">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-6 text-center">
                <img src="{{ asset('images/delete.png') }}" class="mx-auto mb-4" onclick="" alt="Edit" width="48"
                     height="48"/>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete
                    this product?</h3>
                <form method="post" action="{{ route('destroy') }}">
                    @csrf <!-- {{ csrf_field() }} -->
                    <input type="text" id="deleteInputPhotoID" name="deleteInputPhotoID" hidden>
                    <button type="submit" name="deleteButtonModal"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2"
                            onclick="closeModalById('delete-modal')">
                        Yes, I'm sure
                    </button>

                    <button type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                            onclick="closeModalById('delete-modal')">No, cancel
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto p-4 w-3/5 mt-24">
    <button id="addButton" type="button" onclick="showModalById('add-modal')">
        <img src="{{ asset('images/add.png') }}" class="p-2 mb-1 opacity-50 hover:opacity-100"
             alt="Edit" width="50" height="50"/>
    </button>
    <table class="w-full bg-cyan-200 shadow-lg rounded-lg overflow-hidden flex justify-center">
        <tbody>
        @isset($photos)
            @foreach($photos as $photo)
                <tr>
                    <td class="p-4 border-b-2 border-cyan-800">
                        <div class="flex items-center">
                            @foreach($profilePictures as $profilePicture)
                                @if($photo->user->profile_picture_id === $profilePicture->id)
                                    <img src="{{ asset('storage/images/' . $profilePicture->name) }}" alt="User"
                                         class="w-10 h-10 rounded-full">
                                @endif
                            @endforeach

                            <div class="flex">
                                <div class="ml-4">
                                    <div class="text-gray-800 font-semibold">{{ $photo->user->name }}</div>
                                    <div class="text-gray-600">{{ $photo->updated_at }}</div>
                                </div>
                                <p class="mx-10"></p>
                                @if($photo->user->id === $user->id)
                                    <div class="ml-auto flex space-x-4">
                                        <button type="button" name="editButton" id="editButton"
                                                onclick="showModalById('edit-modal'); sendDataForEditModal({{ $photo->id }}, '{{ $photo->description }}')">
                                            <img src="{{ asset('images/edit.png') }}"
                                                 class="opacity-50 hover:opacity-100 mr-2"
                                                 onclick=""
                                                 alt="Edit" width="20" height="20"/>
                                        </button>
                                        <button type="button" name="deleteButton" id="deleteButton"
                                                onclick="showModalById('delete-modal'); sendDataForDeleteModal({{ $photo->id }})">
                                            <img src="{{ asset('images/delete.png') }}"
                                                 class="opacity-50 hover:opacity-100 mr-2" onclick=""
                                                 alt="Delete" width="20" height="20"/>
                                        </button>
                                        @endif

                                    </div>
                            </div>

                        </div>
                        <p class="mt-2 text-gray-700">
                            {{ $photo->description }}
                        </p>
                        <img src="{{ asset('storage/images/' . $photo->name) }}" alt="Post Image"
                             class="mt-4 rounded-lg shadow-md"
                             height="250" width="400">
                    </td>
                </tr>
            @endforeach
        @endisset
        </tbody>
    </table>
</div>


<script>
    const editButton = document.getElementById('editButton');
    const deleteButton = document.getElementById('deleteButton');
    const addButton = document.getElementById('addButton');


    const editModal = document.getElementById('edit-modal');
    const deleteModal = document.getElementById('delete-modal');
    const addModal = document.getElementById('add-modal');

    function showModalById(modalID) {
        const modal = document.getElementById(modalID);
        modal.classList.add('block');
        modal.classList.remove('hidden');
    }

    function closeModalById(modalID) {
        const modal = document.getElementById(modalID);
        modal.classList.remove('block');
        modal.classList.add('hidden');
    }

    function sendDataForDeleteModal(taskID) {
        document.getElementById('deleteInputPhotoID').value = taskID;
    }

    function sendDataForEditModal(taskID, description) {
        document.getElementById('editInputPhotoID').value = taskID;
        document.getElementById('editInputDescription').value = description;
    }

    // Add event listener to close the modal when clicking outside of it
    document.addEventListener('click', (e) => {
        switch (e.target) {
            case editModal:
                closeModalById('edit-modal');
                break;
            case deleteModal:
                closeModalById('delete-modal');
                break;
            case addModal:
                closeModalById('add-modal');
        }
    });

</script>
</body>
</html>
