<template>

    <div class="col-md-3">
        <select class="displayed pull-right" style="display:none">
            <option :selected="display12">Afiseaza 12 produse</option>
            <option :selected="!display12">Afiseaza 24 de produse</option>
        </select>
    </div>

</template>

<script>

export default {

    props: ['display'],

    ready: function() {
        $('.displayed').selectpicker();
    },

    computed: {

        display12: function () {
            if (this.display == 12) {
                return 'true';
            }
            return 'false';
        },

    }

}

</script>
