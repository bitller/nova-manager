<template>

    <!-- BEGIN Order by -->
    <div class="col-md-3">
        <div class="form-group">
            <select class="form-control input input-default order-by" style="display:none">
                <option selected disabled>Ordoneaza dupa</option>
                <option>Cei mai vechi clienti</option>
                <option>Cei mai noi clienti</option>
                <option>Nume in ordine alfabetica</option>
            </select>
        </div>
    </div>
    <!-- END Order by -->

</template>

<script>

export default {

    ready: function() {
        $('.order-by').selectpicker({
            'style': 'input default-input'
        });
    }

}

</script>
