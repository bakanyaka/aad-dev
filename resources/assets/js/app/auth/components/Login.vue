<template>
    <div class="gray-bg" style="height: 100vh">
        <div class="middle-box text-center loginscreen animated fadeInDown">
            <div>
                <div>

                    <h1 class="logo-name">AAD</h1>

                </div>
                <h3>Welcome to Arsenal Admin Dashboard</h3>
                <p>
                    Добро пожаловать в инструментальную панель администратора ОАО МЗ Арсенал
                </p>
                <p>Авторизуйтесь, чтобы приступить к работе</p>
                <form class="m-t" role="form" method="post" action="">
                    <div class="form-group">
                        <input id="username" name="username" type="text" class="form-control" placeholder="Имя пользователя" required>
                    </div>
                    <div class="form-group">
                        <input id="password"  name="password" type="password" class="form-control" placeholder="Пароль" required>
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b">Войти</button>
                </form>
                <p class="m-t">
                    <small>
                        Frontend by <a href="https://wrapbootstrap.com/theme/inspinia-responsive-admin-theme-WB0R5L90S">Inspinia WebApp</a><br>
                        Powered by <a href="https://laravel.com/">Laravel Framework</a><br>
                        &copy; Dmitriy Belyakov 2016
                    </small>
                </p>
            </div>
        </div>
    </div>

</template>