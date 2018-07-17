<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>serviceAdd</title>
</head>
    <body>
        <form action="service_list" method="get">
        {{ csrf_field() }}
            service_id:<input type="text" name="service_id">
            <input type="submit" name="submit">
        </form>
    </body>		
</html>