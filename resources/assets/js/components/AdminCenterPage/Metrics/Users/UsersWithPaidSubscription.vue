<template>

    <div class="col-md-6">

        <!-- BEGIN Panel -->
        <div class="panel panel-success">

            <div class="panel-heading">Utilizatori care au abonament cu plată</div>

            <!-- BEGIN Panel body -->
            <div class="panel-body">
                {{ usersWithPaidSubscription }}
            </div>
            <!-- END Panel body -->

        </div>
        <!-- END Panel -->

    </div>

</template>

<script>

export default {

    props: ['usersWithPaidSubscription']

}

</script>
