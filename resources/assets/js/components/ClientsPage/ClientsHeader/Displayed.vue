<template>

    <div class="col-md-2 col-md-offset-1">
        <div class="pull-right">
        <select class="order-by" style="display:none">
            <option>Bau</option>
            <option>Bau</option>
        </select>
    </div>
    </div>

</template>

<script>

export default {

    ready: function() {
        $('.order-by').selectpicker();
    },

}

</script>
