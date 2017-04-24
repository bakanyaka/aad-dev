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
                            <span class="text-muted small pull-right">Обновлено: <i class="fa fa-clock-o"></i> {{updatedAt}}</span>
                            <h2>Поиск</h2>
                            <p>
                                Введите данные пользователя которого хотите найти
                            </p>
                            <div class="input-group">
                                <input type="text" placeholder="Search client " class="input form-control" v-model="searchText">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn btn-primary" @click="search"> <i class="fa fa-search"></i> Найти</button>
                                </span>
                            </div>
                            <div class="table-responsive m-t-lg animated fadeIn" v-if="users.length">
                                <table class="table table-hover table-condensed ad-user-table">
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
                                    <user v-for="user in users" :user="user"></user>
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
                users: 'users/filteredUsers'
            }),
        },
        methods: {
            ...mapActions({
                fetchUsers: 'users/fetchUsers',
                filterUsers: 'users/filterUsers'
            }),
            search() {
                if (this.searchText.trim().length < 3) {
                    return
                }
                this.filterUsers(this.searchText.trim())
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