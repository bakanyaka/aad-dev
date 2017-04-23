<template>
    <tr @click="fetchUserDetails(user)">
        <td><span v-if="!user.enabled" class="label label-danger">Отключен</span><span class="label label-primary" v-else>Активен</span></td>
        <td>{{user.name}}</td>
        <td>{{user.mail}}</td>
        <td>{{user.title}}</td>
        <td>{{user.localPhone}}</td>
        <td>{{user.department}}</td>
    </tr>
</template>
<script>
    import {mapActions, mapGetters} from "vuex";
    export default {
        props: ['user'],
        methods: {
            ...mapActions({
                fetchUserDetails: 'users/fetchUserDetails'
            })
        }
    }
</script>