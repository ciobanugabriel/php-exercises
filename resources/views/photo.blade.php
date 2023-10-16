<html>
<body>
    <h1>Upload Photo</h1>
    <form method="post" action="{{ route('postPhoto') }}" enctype="multipart/form-data">
                <input type="file" name="image">
                <input type="submit" name="Upload">
    </form>
    <ul>
        @foreach($photos as $photo)
            <li>{{ $photo->name }} <img src="{{ asset('storage/images/' . $photo->name) }}" width="400"></li>
        @endforeach
    </ul>
</body>
</html>
