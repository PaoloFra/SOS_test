<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    {{ get_title() }}
    {{ stylesheet_link('css/bootstrap.min.css') }}
    {{ stylesheet_link('//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css') }}
    {{ stylesheet_link('css/datepicker.css') }}
    {{ stylesheet_link('css/style.css') }}
    <link rel="shortcut icon" href="{{ url('favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Studio Paolo Frangiolli">
</head>
<body>
{{ javascript_include('http://code.jquery.com/jquery-2.1.0.min.js', false) }}
{#{{ javascript_include('http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js', false) }}#}
{{ javascript_include('js/bootstrap.min.js') }}
{{ javascript_include('js/bootstrap-datepicker.js') }}

{{ content() }}
</body>
</html>
