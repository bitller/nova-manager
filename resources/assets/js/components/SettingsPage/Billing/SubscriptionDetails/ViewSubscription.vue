 <template>

    <!-- BEGIN Panel -->
    <div class="panel panel-info">

        <div class="panel-heading">
            <strong>{{ panelTitle }}</strong>
        </div>

        <!-- BEGIN Panel body -->
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <subscribed v-if="subscribed"></subscribed>
                    <on-trial v-if="onTrial" :trial-days="subscription.trial_days"></on-trial>
                    <trial-expired v-if="trialExpired"></trial-expired>
                    <cancelled v-if="cancelled" :on-grace-period="subscription.on_grace_period"></cancelled>
                    <expired v-if="expired"></expired>
                </div>
            </div>
        </div>
        <!-- END Panel body -->
    </div>
    <!-- END Panel -->

    <div id="create-subscription" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Detalii card</h4>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-10 col-md-offset-1">

                            <!-- BEGIN Card number -->
                            <div class="col-md-12">
                                <div class="form-group has-feedback">
                                    <input type="text" class="form-control" placeholder="Numar card"/>
                                    <i class="glyphicon glyphicon-credit-card form-control-feedback grey"></i>
                                </div>
                            </div>
                            <!-- END Card number -->

                            <!--BEGIN Expiry -->
                            <div class="col-md-6">
                                <div class="form-group has-feedback">
                                    <input type="text" class="form-control" placeholder="LL / AA" />
                                    <i class="glyphicon glyphicon-calendar form-control-feedback grey"></i>
                                </div>
                            </div>
                            <!-- END Expiry -->

                            <!-- BEGIN CVC -->
                            <div class="col-md-6">
                                <div class="form-group has-feedback">
                                    <input type="text" class="form-control" placeholder="CVC" />
                                    <i class="glyphicon glyphicon-lock form-control-feedback grey"></i>
                                </div>
                            </div>
                            <!-- END CVC -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button @click="createSubscription" :class="{ 'disabled': loading}" class="btn btn-success">
                        <span v-show="!loading">Plătește 19.99 ron</span>
                        <img v-show="loading" src="/img/loading-bubbles.svg" />
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Anulează</button>
                </div>
            </div>

        </div>
    </div>

</template>

<script>

import Subscribed from '../../../../components/SettingsPage/Billing/SubscriptionDetails/ViewSubscription/Subscribed.vue';
import OnTrial from '../../../../components/SettingsPage/Billing/SubscriptionDetails/ViewSubscription/OnTrial.vue';
import TrialExpired from '../../../../components/SettingsPage/Billing/SubscriptionDetails/ViewSubscription/TrialExpired.vue';
import Cancelled from '../../../../components/SettingsPage/Billing/SubscriptionDetails/ViewSubscription/Cancelled.vue';
import Expired from '../../../../components/SettingsPage/Billing/SubscriptionDetails/ViewSubscription/Expired.vue';

export default {

    data: function() {
        return {
            subscription: '',
            loading: false,
        }
    },

    ready: function() {
        this.getCurrentSubscription();
    },

    components: {
        'subscribed': Subscribed,
        'on-trial': OnTrial,
        'trial-expired': TrialExpired,
        'cancelled': Cancelled,
        'expired': Expired,
    },

    methods: {

        getCurrentSubscription: function() {

            var vn = this;

            this.$http.get('/dashboard/settings/subscription-details/get-current-subscription').then(function (success) {
                vn.subscription = success.data;
            }, function (error) {
                //
            });
        },

        createSubscription: function() {

            var vn = this;
            this.loading = true;

            // Get client token from the server
            this.$http.get('/dashboard/settings/subscription-details/generate-client-token').then(function (success) {

                var client = new braintree.api.Client({
                    clientToken: success.data.client_token
                });

                client.tokenizeCard({
                    number: "4111111111111111",
                    expirationDate: "10/20",
                }, function (error, nonce) {

                    var data = {
                        _token: $('#token').attr('content'),
                        nonce: nonce,
                    };

                    // Send nonce to the server
                    vn.$http.post('/dashboard/settings/subscription-details/new', data).then(function (success) {

                        vn.loading = false;

                    }, function (error) {

                        vn.loading = false;

                    });
                });

            }, function (error) {
                //
            });

        },

    },

    computed: {

        panelTitle: function() {
            if (this.onTrial) {
                return 'Ești în perioada de probă gratuită';
            }

            if (this.cancelled) {
                return 'Abonament anulat';
            }

            if (this.subscribed) {
                return 'Abonament activ';
            }
        },

        onTrial: function() {
            if (this.subscription.on_trial && !this.subscription.subscribed) {
                return true;
            }

            return false;
        },

        subscribed: function() {
            if (this.subscription.subscribed && !this.subscription.cancelled) {
                return true;
            }

            return false;
        },

        trialExpired: function() {
            //
        },

        cancelled: function() {
            if (this.subscription.cancelled) {
                return true;
            }

            return false;
        },

        onGracePeriod: function() {
            if (this.subscription.on_grace_period) {
                return true;
            }

            return false;
        },

        expired: function() {
            //
        },

    }

}

</script>
