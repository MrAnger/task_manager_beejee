<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>{block name=title}{/block}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/app.css">
</head>
<body>
<div id="app">
    {include file="layouts\_header.tpl"}

    <main role="main" class="container">
        {include file="layouts\_flash-list.tpl"}

        {block name=body}{/block}
    </main>
</div>
<script src="js/app.js"></script>
</body>
</html>