<template>

    <div class="col-md-12">

        <div class="col-md-12 primary">
            <div class="col-md-12">
                <span class="primary-title">Informatii personale</span>
            </div>
        </div>

        <div class="col-md-12 white">
            <div class="col-md-12">
                <email :email="email"></email>
                <phone-number :phone-number="phoneNumber"></phone-number>
                <date-of-birth :date="clientBirthDay"></date-of-birth>
            </div>
        </div>

    </div>

</template>

<script>

import Email from '../../components/ClientPage/PersonalInformations/Email.vue';
import PhoneNumber from '../../components/ClientPage/PersonalInformations/PhoneNumber.vue';
import DateOfBirth from '../../components/ClientPage/PersonalInformations/DateOfBirth.vue';

export default {

    data: function() {
        return {
            clientId: $('#client').attr('content'),
            email: '',
            phoneNumber: '',
            birthDay: '',
        }
    },

    ready: function() {
        this.getClientPersonalInformations();
    },

    components: {
        'email': Email,
        'phone-number': PhoneNumber,
        'date-of-birth': DateOfBirth,
    },

    methods: {

        getClientPersonalInformations: function() {

            var vn = this;
            this.$http.get('/dashboard/clients/' + this.clientId + '/personal-informations').then(function (success) {

                vn.email = success.data.email;
                vn.phoneNumber = success.data.phone_number;
                vn.birthDay = success.data.birth_day;

            }, function (error) {
                //
            });

        },

    },

    computed: {

        clientBirthDay: function() {

            if (!this.birthDay) {
                return 'Nu a fost setată';
            }

            return this.birthDay;
        }

    }

}

</script>
