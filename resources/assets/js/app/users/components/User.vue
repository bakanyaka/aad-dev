<template>
    <tr>
        <td><span v-if="!user.enabled" class="label label-danger">Отключен</span><span v-else class="label label-primary">Активен</span></td>
        <td>{{user.name}}</td>
        <td>{{user.mail}}</td>
        <td>{{user.title}}</td>
        <td>{{user.localPhone}}</td>
        <td>{{user.department}}</td>
    </tr>
</template>
<script>
    export default {
        props: ['user']
    }
</script>