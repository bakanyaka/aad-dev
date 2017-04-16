<template>
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">ФИО</strong>
                            </span> <span class="text-muted text-xs block">username <b class="caret"></b></span>
                        </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="#">Мой профиль</a></li>
                            <li><a href="#">Выход</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        AAD
                    </div>
                </li>

                <router-link tag="li" :to="{name: 'home'}" exact>
                    <a><i class="fa fa-th-large"></i> <span class="nav-label">Главная</span></a>
                </router-link>

                <router-link tag="li" :to="{name: 'users'}">
                    <a><i class="fa fa-users"></i> <span class="nav-label">Пользователи</span></a>
                </router-link>

            </ul>

        </div>
    </nav>
</template>


<script>
    import {mapGetters} from 'vuex'
    computed: mapGetters({
        user: 'auth/user'
    })

</script>
