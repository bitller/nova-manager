<template>

    <td class="text-center vert-align">
        <button class="btn btn-default"  @click="deleteBill(id, current_page, to-from)">
            <span class="glyphicon glyphicon-trash"></span>
            Sterge
        </button>
    </td>

</template>
        
<script>
    export default {
        
        props: [],
        
        methods: {
            deleteBill: function() {
                //
            }
        }
    }
</script>