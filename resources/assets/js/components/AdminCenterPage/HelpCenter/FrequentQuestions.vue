<template>

    <all-frequent-questions></all-frequent-questions>
    <create-new-frequent-question></create-new-frequent-question>

</template>

<script>

import AllFrequentQuestions from '../../../components/AdminCenterPage/HelpCenter/FrequentQuestions/AllFrequentQuestions.vue';
import CreateNewFrequentQuestion from '../../../components/AdminCenterPage/HelpCenter/FrequentQuestions/CreateNewFrequentQuestion.vue';

export default {

    components: {
        'all-frequent-questions': AllFrequentQuestions,
        'create-new-frequent-question': CreateNewFrequentQuestion
    }

}

</script>
