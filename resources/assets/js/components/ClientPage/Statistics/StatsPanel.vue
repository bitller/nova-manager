<template>

    <div class="panel panel-success">
        <div class="panel-heading">
            {{ title }}
        </div>
        <div class="panel-body">
            <div class="row text-center"><h4>{{ content }}</h4></div>
        </div>
    </div>

</template>

<script>

export default {

    props: ['title', 'content'],

}

</script>
