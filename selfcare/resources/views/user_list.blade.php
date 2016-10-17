<!DOCTYPE html>
<html>
  <head>
    <title>Users</title>
  </head>
  <body>
    <h1>List</h1>
    @foreach($users_list as $user)
    {{ $user['first_name'] }} - {{$user['last_name']}} <br>
    @endforeach
  </body>
</html>