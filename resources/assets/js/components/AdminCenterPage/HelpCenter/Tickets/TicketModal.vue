<template>

    <!-- BEGIN Modal -->
    <div id="ticket-modal" class="modal fade" data-backdrop="static" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">

                <!-- BEGIN Modal header -->
                <div class="modal-header">
                    <button @click="closeModal" type="button" class="close">&times;</button>
                    <h4 class="modal-title">{{ modal.title }}</h4>
                </div>
                <!-- END Modal header -->

                <!-- BEGIN Modal body -->
                <div class="modal-body">

                  <div class="row">
                      <div class="col-md-12">
                          <h4>Ticket subject goes here</h4>
                          <h5>Lorem Ipsum este pur şi simplu o machetă pentru text a industriei tipografice. Lorem Ipsum a fost macheta standard a industriei încă din secolul al XVI-lea, când un tipograf anonim a luat o planşetă de litere şi le-a amestecat pentru a crea o carte demonstrativă pentru literele respective. Nu doar că a supravieţuit timp de cinci secole, dar şi a facut saltul în tipografia electronică practic neschimbată. A fost popularizată în anii '60 odată cu ieşirea colilor Letraset care conţineau pasaje Lorem Ipsum, iar mai recent, prin programele de publicare pentru calculator, ca Aldus PageMaker care includeau versiuni de Lorem Ipsum.</h5>
                          <hr>
                      </div>
                  </div>
              </div>
              <!-- END Modal body -->

              <div class="modal-footer">
                <button @click="closeModal" type="button" class="btn btn-default">{{ modal.cancelButton }}</button>
                <!-- <button @click="createBill" type="button" class="btn btn-primary">{{ modal.submitButton }}</button> -->
              </div>
        </div>

        </div>
    </div>
    <!-- END Modal -->

</template>

<script>

export default {

    data: function() {
        return {
            modal: {
                selector: '#ticket-modal',
                title: 'Detalii tichet',
                cancelButton: 'Inchide',
            },
        }
    },

    methods: {

        showModal: function(ticketId) {
            $('#ticket-modal').modal('show');
        },

        closeModal: function() {
            //
        },
    },

    events: {
        'showTicketModal': function(ticketId) {
            this.showModal();
        },
    }

}

</script>
