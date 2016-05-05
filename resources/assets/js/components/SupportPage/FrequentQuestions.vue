<template>

    <div class="col-md-12">

        <div class="col-md-12 primary">
            <div class="col-md-12">
                <span class="primary-title">Întrebări frecvente</span>
            </div>
        </div>

        <div class="col-md-12 white">
            <div class="col-md-10 col-md-offset-1">
                <question title="Cum creez o factura?"></question>
                <question title="Cum creez o factura?"></question>
                <question title="Cum creez o factura?"></question>

            </div>
        </div>

    </div>

</template>

<script>

import Question from '../../components/SupportPage/FrequentQuestions/Question.vue';

export default {

    components: {
        'question': Question,
    },

}

</script>
