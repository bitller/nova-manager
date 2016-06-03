<template>

    <div class="col-md-3">
        <select class="order-by pull-right" style="display:none">
            <option>Crescator</option>
            <option>Descrescator</option>
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
