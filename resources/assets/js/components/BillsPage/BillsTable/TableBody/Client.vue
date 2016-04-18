<template>
    <td class="text-center vert-align">
        <a href="/bills/{{ bill_id }}">{{ client_name }}</a>
    </td>
</template>

<script>
    export default {
        
        props: ['bill_id', 'client_name']
        
    }
</script>