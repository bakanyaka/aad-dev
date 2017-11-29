<template>
    <tr @click="fetchUserDetails(user)">
        <td><span v-if="!user.enabled" class="label label-danger">Отключен</span><span class="label label-primary" v-else>Активен</span></td>
        <td>{{user.name}}</td>
        <td>{{user.account}}</td>
        <td>{{user.title}}</td>
        <td>{{phoneNumber}}</td>
        <td>{{user.department}}</td>
    </tr>
</template>
<script>
    import {mapActions, mapGetters} from "vuex";
    export default {
        props: ['user'],
        computed: {
            phoneNumber() {
                const phones = [];
                if (this.user.localPhone !== null) {
                    phones.push(this.user.localPhone)
                }
                if (this.user.cityPhone !== null) {
                    phones.push(this.user.cityPhone)
                }
                if (this.user.mobilePhone !== null) {
                    phones.push(this.user.mobilePhone)
                }
                return phones.join(', ');
            }
        },
        methods: {
            ...mapActions({
                fetchUserDetails: 'users/fetchUserDetails'
            })
        }
    }
</script>