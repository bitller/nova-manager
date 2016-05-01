<template>

    <div class="col-md-12">

        <div class="col-md-12 primary">
            <div class="col-md-12">
                <span class="primary-title">Informatii personale</span>
            </div>
        </div>

        <div class="col-md-12 white">
            <div class="col-md-12">
                <email email="john.doe@bitller.com"></email>
                <phone-number phone-number="0730167964"></phone-number>
                <date-of-birth date="04.01.1997"></date-of-birth>
            </div>
        </div>

    </div>

</template>

<script>

import Email from '../../components/ClientPage/PersonalInformations/Email.vue';
import PhoneNumber from '../../components/ClientPage/PersonalInformations/PhoneNumber.vue';
import DateOfBirth from '../../components/ClientPage/PersonalInformations/DateOfBirth.vue';

export default {

    components: {
        'email': Email,
        'phone-number': PhoneNumber,
        'date-of-birth': DateOfBirth,
    }

}

</script>
