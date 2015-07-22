<head>
    <script type="text/javascript" src="//vk.com/js/api/openapi.js"></script>
</head>
<body>
<script>
    VK.init({apiId: 5005271});
</script>
<div id="vk_auth"></div>
<script type="text/javascript">
    VK.Widgets.Auth("vk_auth", {width: "300px", authUrl: '/vklogin.php?'});
</script>
</body>