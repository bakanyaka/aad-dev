<template>
    <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                <form role="search" class="navbar-form-custom" method="post" action="/">
                    <div class="form-group">
                        <input type="text" placeholder="Что-нибудь найти..." class="form-control" name="top-search" id="top-search" />
                    </div>
                </form>
            </div>
            <ul class="nav navbar-top-links navbar-right ">
                <li v-if="user.authenticated">
                    <a href="#" @click.prevent="signout">
                        <i class="fa fa-sign-out"></i> Выход
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</template>
<script>
    import {mapGetters, mapActions} from 'vuex'

    export default {
        computed: mapGetters({
            user:'auth/user'
        }),
        methods: {
            ...mapActions({
                logout: 'auth/logout'
            }),
            signout() {
                this.logout().then(() => {
                    this.$router.replace({name: 'login'})
                })
            }
        }
    }

</script>