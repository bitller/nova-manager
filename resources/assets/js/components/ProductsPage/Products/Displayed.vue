<template>

    <div class="col-md-3">
        <select class="displayed pull-right" style="display:none">
            <option>10</option>
            <option>20</option>
            <option>50</option>
        </select>
    </div>

</template>

<script>

export default {

    ready: function() {
        $('.displayed').selectpicker({
            'style': 'form-control'
        });
    },

}

</script>
