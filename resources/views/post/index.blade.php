<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>posts</h1>
        <a href="posts/create" class="btn btn-primary">create new post</a>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>id</th>
                <th>title</th>
                <th>slug</th>
                <th>is_featured</th>
                <th>status</th>
                <th>image</th>
                <th>excerpt</th>
                <th>content</th>
                <th>posted_at</th>
                <th>created_at</th>
                <th>updated_at</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->slug }}</td>
                    <td>{{ $post->is_featured }}</td>
                    <td>{{ $post->status }}</td>
                    <td><img src="{{ asset('images/' . $post->image) }}" alt="img" width="50" height="50"/></td>
                    <td>{{ $post->excerpt }}</td>
                    <td>{{ $post->content }}</td>
                    <td>{{ $post->posted_at }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>{{ $post->updated_at }}</td>
                    <td>
                        <a href="/posts/{{ $post->id }}" class="btn btn-success">update</a>
                        <form method="post" action="/posts/{{ $post->id }}">
                            @csrf
                            @method("DELETE")
                            <button class="btn btn-danger">delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    
</body>
</html>