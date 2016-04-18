<template>
    <td class="text-center vert-align">
        <a href="/statistics/campaign/{{ campaign_number }}/{{ campaign_year }}">
            {{ campaign_number }}/{{ campaign_year }}
        </a>
    </td>
</template>
    
<script>
    export default {
        
        props: ['campaign_number', 'campaign_year']
        
    }
</script>