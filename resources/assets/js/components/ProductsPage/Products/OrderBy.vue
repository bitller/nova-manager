<template>

    <div class="col-md-3">
        <select class="order-by pull-right" style="display:none">
            <option>Nume</option>
            <option>cod</option>
        </select>
    </div>

</template>

<script>

export default {

    ready: function() {
        $('.order-by').selectpicker({
            'style': 'form-control'
        });
    },

}

</script>
