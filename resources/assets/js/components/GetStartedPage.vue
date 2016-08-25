<template>

    <first-step v-if="firstStepIsActive"></first-step>
    <second-step v-if="secondStepIsActive"></second-step>

</template>

<script>

import FirstStep from '../components/GetStartedPage/FirstStep.vue';
import SecondStep from '../components/GetStartedPage/SecondStep.vue';

export default {

    components: {
        'first-step': FirstStep,
        'second-step': SecondStep,
    },

    data: function() {
        return {
            step: 'first',
        }
    },

    methods: {
        makeFirstStepActive: function() {
            this.step = 'first';
        },
        makeSecondStepActive: function() {
            this.step = 'second';
        },
    },

    events: {
        'makeFirstStepActive': function() {
            this.makeFirstStepActive();
        },
        'makeSecondStepActive': function() {
            this.makeSecondStepActive();
        }
    },

    computed: {
        firstStepIsActive: function() {
            if (this.step === 'first') {
                return true;
            }
            return false;
        },

        secondStepIsActive: function() {
            if (this.step === 'second') {
                return true;
            }
            return false;
        },
    }

}

</script>
