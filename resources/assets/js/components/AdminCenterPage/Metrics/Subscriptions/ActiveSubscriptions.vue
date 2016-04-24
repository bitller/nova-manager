<template>

    <div class="col-md-6">

        <!-- BEGIN Panel -->
        <div class="panel panel-success">

            <div class="panel-heading">Abonamente active</div>

            <!-- BEGIN Panel body -->
            <div class="panel-body">
                <div class="row text-center">
                    <h4>{{ activeSubscriptions }}</h4>
                </div>
            </div>
            <!-- END Panel body -->

        </div>

    </div>

</template>

<script>

export default {

    props: ['activeSubscriptions'],

}

</script>
