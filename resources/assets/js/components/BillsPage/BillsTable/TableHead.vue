<template>
    <thead>
        <tr>
            <th is="client"></th>
            <th is="number-of-products"></th>
            <th is="price"></th>
            <th is="campaign-order"></th>
            <th is="campaign"></th>
            <th is="payment-term"></th>
            <th is="delete-bill"></th>
        </tr>
    </thead>
</template>

<script>
    
    import Client from '../../../components/BillsPage/BillsTable/TableHead/Client.vue';
    import NumberOfProducts from '../../../components/BillsPage/BillsTable/TableHead/NumberOfProducts.vue';
    import Price from '../../../components/BillsPage/BillsTable/TableHead/Price.vue';
    import CampaignOrder from '../../../components/BillsPage/BillsTable/TableHead/CampaignOrder.vue';
    import Campaign from '../../../components/BillsPage/BillsTable/TableHead/Campaign.vue';
    import PaymentTerm from '../../../components/BillsPage/BillsTable/TableHead/PaymentTerm.vue';
    import DeleteBill from '../../../components/BillsPage/BillsTable/TableHead/DeleteBill.vue';
    
    export default {
        
        components: {
            'client': Client,
            'number-of-products': NumberOfProducts,
            'price': Price,
            'campaign-order': CampaignOrder,
            'campaign': Campaign,
            'payment-term': PaymentTerm,
            'delete-bill': DeleteBill
        }
        
    }
</script>