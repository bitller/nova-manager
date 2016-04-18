<template>
    
    <td class="text-center vert-align">
        <span v-if="payment_term">{{ payment_term }}</span>
        <span v-else>Nu a fost setat</span>
    </td>
    
</template>
    
<script>
    export default {
        
        props: ['payment_term']
        
    }
</script>