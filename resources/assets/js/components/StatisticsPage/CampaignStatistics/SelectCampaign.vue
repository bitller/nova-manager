<template>

    <div class="panel panel-default">
        <div class="panel-heading">
            Statisticile campaniei 4/2016
        </div>
        <div class="panel-body">
            <label>Selecteaza alta camanie</label>
            <select class="select-campaign-year" style="display: none">
                <option>Bau</option>
            </select>
            <select class="select-campaign-number" style="display: none">
                <option>Bau</option>
            </select>
        </div>
    </div>

</template>

<script>

export default {

    ready: function() {
        $('.select-campaign-year, .select-campaign-number').selectpicker();
    },

}

</script>
