<template>
    <div class="well custom-well margin-bottom register-form col-md-6 col-md-offset-3">
        <div class="col-md-10 col-md-offset-1">

            <create-account-icon></create-account-icon>

            <free-period></free-period>

            <your-profile></your-profile>

            <create-account-form></create-account-from>

        </div>
    </div>
</template>
    
<script>
        
    import FreePeriod from '../components/RegisterPage/FreePeriod.vue';
    import YourProfile from '../components/RegisterPage/YourProfile.vue';
    import CreateAccountForm from '../components/RegisterPage/CreateAccountForm.vue';
    import CreateAccountIcon from '../components/RegisterPage/CreateAccountIcon.vue';

    export default {
        
        components: {
            'free-period': FreePeriod,
            'your-profile': YourProfile,
            'create-account-form': CreateAccountForm,
            'create-account-icon': CreateAccountIcon
        },
        
        data: function() {
            return {
                //
            }
        }
    }
</script>