<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @auth
    <p>Congratulations! You're registered!</p>
    <form action="/logout" method="POST">
        @csrf
        <button>Logout</button>
    </form>
    <div style="border: 3px solid black;">
        <h2>Create new item</h2>
        <form action="/create-post" method="POST">
            @csrf
            <input name="title" type="text" placeholder="title">
            <textarea name="description" placeholder="description"></textarea>
            <button>Save</button>
        </form>
    </div>
    <div style="border: 3px solid black;">
        <h2>All Post</h2>
        @foreach($posts as $post)
        <div style="background-color: gray; padding: 10px; margin: 10px;">
            <h3>{{$post['title']}} by {{$post->user->name}}</h3>
            {{$post['description']}}
            <p><a href="/edit-post/{{$post->id}}">Edit</a></p>
            <form action="/delete-post/{{$post->id}}" method="POST">
                @csrf
                @method('DELETE')
                <button>Delete</button>
            </form>
        </div>
        @endforeach
    </div>

    @else
    <div style="border: 3px solid black;">
        <h2>Register </h2>
        <form action="/saveList" method="POST">
            @csrf
            <input name="name" type="text" placeholder="name">
            <input name="email" type="text" placeholder="email">
            <input name="password" type="password" placeholder="password">
            <button>Register</button>
        </form>
    </div>
    <div style="border: 3px solid black;">
        <h2>Login </h2>
        <form action="/login" method="POST">
            @csrf
            <input name="login_name" type="text" placeholder="name">
            <input name="login_password" type="password" placeholder="password">
            <button>Login</button>
        </form>
    </div>
    @endauth

    
</body>
</html>