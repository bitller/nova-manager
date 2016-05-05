<template>

    <div class="page-container">

        <div class="row">
            <support-header></support-header>
            <frequent-questions></frequent-questions>
            <ask-question></ask-question>
        </div>

    </div>

</template>

<script>

import SupportHeader from '../components/SupportPage/SupportHeader.vue';
import FrequentQuestions from '../components/SupportPage/FrequentQuestions.vue';
import AskQuestion from '../components/SupportPage/AskQuestion.vue';

export default {

    components: {
        'support-header': SupportHeader,
        'frequent-questions': FrequentQuestions,
        'ask-question': AskQuestion,
    },

}

</script>
