<template>
    <div>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-12">
                <h2>Пользователи</h2>
                <ol class="breadcrumb">
                    <li>
                        <router-link :to="{name: 'home'}">Главная</router-link>
                    </li>
                    <li class="active">
                        <strong>Пользователи</strong>
                    </li>
                </ol>
            </div>
        </div>
        <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-sm-8">
                    <div class="ibox">
                        <div class="ibox-content">
                            <span class="text-muted small pull-right">Last modification: <i class="fa fa-clock-o"></i> 2:10 pm - 12.06.2014</span>
                            <h2>Поиск</h2>
                            <p>
                                Введите данные пользователя которого хотите найти
                            </p>
                            <div class="input-group">
                                <input type="text" placeholder="Search client " class="input form-control">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn btn-primary"> <i class="fa fa-search"></i> Найти</button>
                                </span>
                            </div>
                            <div class="table-responsive m-t-lg animated fadeIn">
                                <table class="table table-striped table-condensed ad-user-table">
                                    <thead>
                                    <tr>
                                        <th>Cтатус</th>
                                        <th>ФИО</th>
                                        <th>E-mail</th>
                                        <th>Должность</th>
                                        <th>Номер телефона</th>
                                        <th>Подразделение</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <ad-user v-for="user in users" :user="user"></ad-user>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="ibox ">

                        <div class="ibox-content">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import AdUser from './User.vue'
    import {mapGetters} from "vuex";
    export default {
        computed: {
            ...mapGetters({
                users: 'users/allUsers'
            })
        },
        components: {
            AdUser
        }
    }
</script>