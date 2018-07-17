<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>serviceAdd</title>
</head>
    <body>
        <form action="service_add" method="post">
        {{ csrf_field() }}
            id:<input type="text" name="id">
            service_name:<input type="text" name="name">
            level:<input type="text" name="level">
	        gid:<input type="text" name="gid">
            create_time: <input type="datetime-local" name="create_time">
            <input type="submit" name="submit">
        </form>
    </body>		
</html>
