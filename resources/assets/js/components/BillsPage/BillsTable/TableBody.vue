<template>

    <tbody>
        <tr>
            <th is="client" client_name="Alex" bill_id="4"></th>
            <th is="number-of-products" number="4"></th>
            <th is="price" price="4.44"></th>
            <th is="campaign-order" order="1"></th>
            <th is="campaign" campaign_year="2016" campaign_number="4"></th>
            <th is="payment-term"></th>
            <th is="delete-bill"></th>
        </tr>
    </tbody>

</template>

<script>

    import Client from '../../../components/BillsPage/BillsTable/TableBody/Client.vue';
    import NumberOfProducts from '../../../components/BillsPage/BillsTable/TableBody/NumberOfProducts.vue';
    import Price from '../../../components/BillsPage/BillsTable/TableBody/Price.vue';
    import CampaignOrder from '../../../components/BillsPage/BillsTable/TableBody/CampaignOrder.vue';
    import Campaign from '../../../components/BillsPage/BillsTable/TableBody/Campaign.vue';
    import PaymentTerm from  '../../../components/BillsPage/BillsTable/TableBody/PaymentTerm.vue';
    import DeleteBill from '../../../components/BillsPage/BillsTable/TableBody/DeleteBill.vue';

    export default {

        props: ['bills'],

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