<template>

    <tickets-metrics></tickets-metrics>
    <opened-tickets></opened-tickets>
    <closed-tickets></closed-tickets>
    <ticket-modal></ticket-modal>

</template>

<script>

import TicketsMetrics from '../../../components/AdminCenterPage/HelpCenter/Tickets/TicketsMetrics.vue';
import OpenedTickets from '../../../components/AdminCenterPage/HelpCenter/Tickets/OpenedTickets.vue';
import ClosedTickets from '../../../components/AdminCenterPage/HelpCenter/Tickets/ClosedTickets.vue';
import TicketModal from '../../../components/AdminCenterPage/HelpCenter/Tickets/TicketModal.vue';

export default {

    components: {
        'tickets-metrics': TicketsMetrics,
        'opened-tickets': OpenedTickets,
        'closed-tickets': ClosedTickets,
        'ticket-modal': TicketModal,
    },

    events: {
        'showTicketModal': function(ticketId) {
            this.$broadcast('showTicketModal', ticketId);
        }
    }

}

</script>
