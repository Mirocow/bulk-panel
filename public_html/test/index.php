<head>
    <script type="text/javascript" src="//vk.com/js/api/openapi.js?116"></script>
</head>
<body>
    <script>
        VK.init({apiId: 5005271});
    </script>
    <div id="lol" onclick="login()">1</div>
    <script type="text/javascript">
        function login(){
        VK.Auth.login(function(response) {
            console.log(response);
            if (response.session) {
                if (response.settings) {
                    /* Выбранные настройки доступа пользователя, если они были запрошены */
                }
            } else {
                /* Пользователь нажал кнопку Отмена в окне авторизации */
            }
        });}
    </script>
</body>