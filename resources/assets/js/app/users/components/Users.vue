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
                        <div class="ibox-content" v-bind:class="{'sk-loading': loadingUsers}">
                            <span class="text-muted small pull-right">
                                Обновлено: <i class="fa fa-clock-o"></i> {{updatedAt}} <button
                                    class="btn btn-white btn-sm" v-on:click="updateUsers"><i class="fa fa-refresh"></i> Обновить</button>
                            </span>
                            <h2>Поиск</h2>
                            <p>
                                Введите данные пользователя которого хотите найти
                            </p>
                            <input type="text"
                                   placeholder="Введите имя пользователя, учетную запись, телефон или имя компьютера"
                                   class="input form-control" v-model="searchText">
                            <div class="sk-spinner sk-spinner-wave">
                                <div class="sk-rect1"></div>
                                <div class="sk-rect2"></div>
                                <div class="sk-rect3"></div>
                                <div class="sk-rect4"></div>
                                <div class="sk-rect5"></div>
                            </div>
                        </div>
                    </div>
                    <div class="ibox animated fadeIn" v-if="users.length">
                        <div class="ibox-content">
                            <div class="table-responsive m-t-lg">
                                <table class="table table-hover table-condensed ad-user-table">
                                    <thead>
                                    <tr>
                                        <th>Cтатус</th>
                                        <th>ФИО</th>
                                        <th>Учетная запись</th>
                                        <th>Должность</th>
                                        <th>Номер телефона</th>
                                        <th>Подразделение</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <user v-for="user in users" :key='user.account' :user="user"></user>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <user-details></user-details>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import moment from 'moment'
    import User from './User.vue'
    import UserDetails from './UserDetails.vue'
    import {mapActions, mapGetters} from 'vuex';
    import {debounce} from 'lodash'
    export default {
        data() {
            return {
                updatedAt: 'Никогда',
                searchText: ''
            }
        },
        watch: {
            searchText: _.debounce(function () {
                this.search();
            }, 200)
        },
        computed: {
            ...mapGetters({
                users: 'users/foundUsers',
                loadingUsers: 'users/loadingUsers'
            }),
        },
        methods: {
            ...mapActions({
                fetchUsers: 'users/fetchUsers',
                findUsers: 'users/findUsers'
            }),
            search() {
                if (this.searchText.trim().length < 3) {
                    return
                }
                this.findUsers(this.searchText.trim())
            },
            updateUsers() {
                this.fetchUsers().then(() => {
                    this.updatedAt = moment().format('llll')
                })
            }
        },
        components: {
            User,
            UserDetails
        },
        mounted() {
            this.updateUsers()
        }
    }
</script>