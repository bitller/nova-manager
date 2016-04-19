<template>

    <button type="button" data-toggle="modal" data-target="#create-bill-modal" class="btn btn-primary pull-right">
        <span class="glyphicon glyphicon-plus"></span>
        Creeaza factura
    </button>

    <!-- BEGIN Create bill modal -->
    <div id="create-bill-modal" data-backdrop="static" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Creeaza factura</h4>
                </div>

                <!-- BEGIN Modal body -->
                <div class="modal-body col-md-12">

                    <!-- BEGIN Error message -->
                    <div class="col-md-12" v-show="error">
                        <div class="alert alert-danger">@{{ error }}</div>
                    </div>
                    <!-- END Error message -->

                    <!-- BEGIN Client name -->
                    <div role="form" class="col-md-12">
                        <div class="form-group has-feedback client-name">
                            <label for="client-name">Numele clientului:</label>
                            <input @keyup.enter="autocomplete" type="text" class="twitter-typeahead form-control" id="client-name">
                                <i class="glyphicon glyphicon-refresh glyphicon-spin form-control-feedback add-product-to-bill-loader"></i>
                        </div>
                    </div>
                    <!-- END Client name -->

                    <!-- BEGIN Use current campaign -->
                    <div class="checkbox col-md-12">
                        <label>
                            <input type="checkbox" checked="use_current_campaign" />
                            foloseste campania actuala
                        </label>
                        <span class="badge" data-toggle="tooltip" data-placement="right" title="foloseste campania actuala">?</span>
                    </div>
                    <!-- END Use current campaign -->

                    <!-- BEGIN Choose another campaign -->
                    <div class="col-md-12">
                        <div class="form-group col-md-4">
                            <label for="campaign-year">Anul campaniei</label>
                            <select class="form-control" id="campaign-year">
                                <option selected="selected">2016</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="campaign-number">Numarul campaniei</label>
                            <select class="form-control" id="campaign-number">
                                <option selected="selected">1</option>
                            </select>
                        </div>
                    </div>
                    <!-- END Choose another campaign -->

                </div>
                <!-- END Modal body -->

                <!-- BEGIN Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Anuleaza</button>
                    <button type="button" class="btn btn-primary">
                        <span v-show="loading" class="glyphicon glyphicon-refresh glyphicon-spin"></span>
                        <span v-show="!loading">Creeaza factura}</span>
                    </button>
                </div>
                <!-- END Modal footer -->

            </div>
            <!-- END Modal content -->
        </div>
    </div>
    <!-- END Create bill modal -->

</template>

<script>
    export default {

        ready: function() {
            this.autocomplete();
        },

        methods: {
            autocomplete: function() {

                var Bloodhound = require("typeahead.js-browserify").Bloodhound;

                // Search engine for client suggestions
                var clients = new Bloodhound({

                    datumTokenizer: function (datum) {
                        return Bloodhound.tokenizers.whitespace(datum.value);
                    },

                    queryTokenizer: Bloodhound.tokenizers.whitespace,

                    remote: {
                        ajax: {
                            // Show loader when request is made
                            beforeSend: function(xhr) {
                            $('.client-name i').show();
                        },
                        // Hide loader after request
                        complete: function() {
                            $('.client-name i').hide();
                        }
                    },

                    cache: false,

                    url: '/dashboard/bills/suggest-clients?name=',

                    replace: function() {
                        var url = '/dashboard/bills/suggest-clients?name=';
                        if ($('#client-name').val()) {
                            url += encodeURIComponent($('#client-name').val())
                        }
                        return url;
                    },

                    filter: function (clients) {
                        // Map the remote source JSON array to a JavaScript object array
                        return $.map(clients, function (client) {
                            return {
                                name: client.name
                            };
                        });
                    }
                }
            });

            // Initialize the Bloodhound suggestion engine
            clients.initialize();

            var clientInput = $('.twitter-typeahead');

            // Instantiate the Typeahead UI
            clientInput.typeahead(null, {
                displayKey: 'name',
                source: clients.ttAdapter(),
                templates: {
                    suggestion: function(client) {
                        return '<p>' + client.name + '</p>'
                    }
                }
            });
        }
    }
}
</script>
