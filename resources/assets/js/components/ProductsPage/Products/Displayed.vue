<template>

    <div class="col-md-3">
        <select class="displayed pull-right" style="display:none">
            <option>Afiseaza 10 produse</option>
            <option>Afiseaza 20 de produse</option>
        </select>
    </div>

</template>

<script>

export default {

    ready: function() {
        $('.displayed').selectpicker();
    },

}

</script>
