<template>

    <div class="col-md-4 col-md-offset-2">
        <select class="order-by pull-right" style="display:none">
            <option>Bau</option>
            <option>Bau</option>
        </select>
    </div>

</template>

<script>

export default {

    ready: function() {
        $('.order-by').selectpicker();
    },

}

</script>
