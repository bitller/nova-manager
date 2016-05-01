<template>

    <div class="col-md-12">

        <div class="col-md-12 primary">
            <div class="col-md-12">
                <span class="primary-title">Notificări</span>
            </div>
        </div>
        
        <div class="col-md-12 white">
            <div class="col-md-12">
                <notification type="danger" title="Factura neplatita" content="John are o factura in valoare de 94.44 ron al carei termen de plata a expirat in 22.22.2015"></notification>
            </div>
        </div>

    </div>

</template>

<script>

import Notification from '../../components/ClientPage/Notifications/Notification.vue';

export default {

    components: {
        'notification': Notification,
    }

}

</script>
