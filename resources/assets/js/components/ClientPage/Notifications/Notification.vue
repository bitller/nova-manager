<template>

    <div class="panel panel-{{ type }}">
        <div class="panel-heading">
            {{ title }}
        </div>
        <div class="panel-body">
            {{ content }}
        </div>
    </div>

</template>

<script>

export default {

    props: ['type', 'title', 'content'],
    
}

</script>
