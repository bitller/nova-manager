<template>

    <div class="col-md-6">

        <!-- BEGIN Panel -->
        <div class="panel panel-success">

            <div class="panel-heading">Abonamente de probă</div>

            <!-- BEGIN Panel body -->
            <div class="panel-body">
                <div class="row text-center">
                    <h4>{{ trialSubscriptions }}</h4>
                </div>
            </div>
            <!-- END Panel body -->

        </div>
        <!-- END Panel -->

    </div>

</template>

<script>

export default {

    props: ['trialSubscriptions'],

}

</script>
