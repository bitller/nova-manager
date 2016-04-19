<template>
    <div class="well custom-well login-form col-md-6 col-md-offset-3">
        <div class="col-md-10 col-md-offset-1">

            <login-icon></login-icon>
            <login-form></login-form>
        </div>
    </div>
</template>

<script>

import LoginIcon from '../components/LoginPage/LoginIcon.vue';
import LoginForm from '../components/LoginPage/LoginForm.vue'

export default {

    components: {
        'login-icon': LoginIcon,
        'login-form': LoginForm
    }

}
</script>