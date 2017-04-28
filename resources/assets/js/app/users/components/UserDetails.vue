<template xmlns:v-clipboard="http://www.w3.org/1999/xhtml">
    <div class="ibox">
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12">
                    <div v-if="loadingUserDetails" class="sk-spinner sk-spinner-fading-circle loading-user-details">
                        <div class="sk-circle1 sk-circle"></div>
                        <div class="sk-circle2 sk-circle"></div>
                        <div class="sk-circle3 sk-circle"></div>
                        <div class="sk-circle4 sk-circle"></div>
                        <div class="sk-circle5 sk-circle"></div>
                        <div class="sk-circle6 sk-circle"></div>
                        <div class="sk-circle7 sk-circle"></div>
                        <div class="sk-circle8 sk-circle"></div>
                        <div class="sk-circle9 sk-circle"></div>
                        <div class="sk-circle10 sk-circle"></div>
                        <div class="sk-circle11 sk-circle"></div>
                        <div class="sk-circle12 sk-circle"></div>
                    </div>
                    <div v-else-if="userDetails">
                        <div class="m-b-md">
                            <a href="#" class="btn btn-white btn-xs pull-right">Редактировать</a>
                            <h2>{{userDetails.firstName}} {{userDetails.lastName}}</h2>
                        </div>
                        <dl class="dl-horizontal">
                            <dt>Статус:</dt>
                            <dd class="m-b"><span v-if="!userDetails.enabled" class="label label-danger">Отключен</span><span
                                    class="label label-primary" v-else>Активен</span></dd>
                            <dt>Фамилия:</dt>
                            <dd>{{userDetails.lastName}}</dd>
                            <dt>Имя:</dt>
                            <dd>{{userDetails.firstName}}</dd>
                            <dt>Отчество:</dt>
                            <dd>{{userDetails.middleName}}</dd>
                            <dt>Внутренняя почта:</dt>
                            <dd>{{userDetails.mail}}</dd>
                            <dt>Должность:</dt>
                            <dd>{{userDetails.title}}</dd>
                            <dt>Местный телефон</dt>
                            <dd>{{userDetails.localPhone}}</dd>
                            <dt>Городской телефон</dt>
                            <dd>{{userDetails.cityPhone}}</dd>
                            <dt>Мобильный телефон</dt>
                            <dd>{{userDetails.mobilePhone}}</dd>
                            <dt>Подразделение</dt>
                            <dd>{{userDetails.department}}</dd>
                            <dt>Компьютеры:</dt>
                            <dd>
                                <ul v-if="userDetails.computers.length">
                                    <li v-for="computer in userDetails.computers">
                                        {{computer.name}}
                                    </li>
                                </ul>
                                <span v-else>Компьютеров не найдено</span>
                            </dd>
                            <dt>Действия:</dt>
                            <dd>
                                <button class="btn btn-white" type="button" v-clipboard:copy="clipboard">
                                    <i class="fa fa-copy text-navy"></i>
                                </button>
                            </dd>
                        </dl>
                    </div>
                    <div class="panel panel-primary" v-else>
                        <div class="panel-heading"><i class="fa fa-info-circle"></i> Выберите пользователя</div>
                        <div class="panel-body">Выберите пользователя из списка для отображения подробной информации
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--    <div v-if="userDetails">
            <div><span v-if="!userDetails.enabled" class="label label-danger">Отключен</span><span class="label label-primary" v-else>Активен</span></div>
            <div>{{userDetails.name}}</div>
            <div>{{userDetails.mail}}</div>
            <div>{{userDetails.title}}</div>
            <div>{{userDetails.localPhone}}</div>
            <div>{{userDetails.department}}</div>
        </div>-->
</template>
<script>
    import {mapActions, mapGetters} from "vuex";
    import VueClipboard from 'vue-clipboard2';
    import Vue from 'vue'

    Vue.use(VueClipboard);

    export default {
        computed: {
            ...mapGetters({
                userDetails: 'users/userDetails',
                loadingUserDetails: 'users/loadingUserDetails'
            }),
            phoneNumber() {
                const phones = [];
                if (this.userDetails.localPhone !== null) {
                    phones.push(this.userDetails.localPhone)
                }
                if (this.userDetails.cityPhone !== null) {
                    phones.push(this.userDetails.cityPhone)
                }
                if (this.userDetails.mobilePhone !== null) {
                    phones.push(this.userDetails.mobilePhone)
                }
                return phones.join(', ');
            },
            clipboard() {
                return  `ФИО: ${this.userDetails.displayName}\n` +
                        `Должность: ${this.userDetails.title}\n` +
                        `Подразделение: ${this.userDetails.department}\n` +
                        `Учетная запись: ${this.userDetails.mail}\n` +
                        `Телефон: ${this.phoneNumber}\n` +
                        `Компьютеры: ${this.userDetails.computers.map(computer => computer.name).join(', ')}\n`
            }
        }
    }
</script>
