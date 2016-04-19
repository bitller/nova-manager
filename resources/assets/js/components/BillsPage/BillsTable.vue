<template>

    <div class="panel panel-default">
        <table class="table table-hover table-bordered">
            <thead is="table-head"></thead>
            <tbody is="table-body"></tbody>
        </table>
    </div>

</template>

<script>

import TableHead from '../../components/BillsPage/BillsTable/TableHead.vue';
import TableBody from '../../components/BillsPage/BillsTable/TableBody.vue';

export default {

    components: {
        'table-head': TableHead,
        'table-body': TableBody
    }

}
</script>