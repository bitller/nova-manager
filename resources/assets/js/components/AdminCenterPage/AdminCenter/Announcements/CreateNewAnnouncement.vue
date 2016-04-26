<template>

    <!-- BEGIN Panel -->
    <div class="panel panel-default">

        <div class="panel-heading">Creează un anunţ nou</div>

        <!-- BEGIN Panel body -->
        <div class="panel-body">

            <div class="form-horizontal" role="form">

                <!-- BEGIN Announcement title -->
                <div class="form-group">
                    <label class="control-label col-md-3 col-md-offset-1">Titlul anunțului</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" />
                    </div>
                </div>
                <!-- END  Announcement title -->

                <!-- BEGIN Announcement content -->
                <div class="form-group">
                    <label class="control-label col-md-3 col-md-offset-1">Conținutul anunțului</label>
                    <div class="col-md-7">
                        <textarea class="form-control"></textarea>
                    </div>
                </div>
                <!-- END Announcement content -->

                <!-- BEGIN Action button text -->
                <div class="form-group">
                    <label class="control-label col-md-3 col-md-offset-1">Text buton</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" />
                    </div>
                </div>
                <!-- END Action button text -->

                <!-- BEGIN Action button url -->
                <div class="form-group">
                    <label class="control-label col-md-3 col-md-offset-1">Adresă buton</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" />
                    </div>
                </div>
                <!-- END Action button url -->

                <!-- BEGIN Post -->
                <div class="form-group">
                    <div class="col-md-offset-4 col-md-3">
                        <div class="btn btn-primary">Publică anunțul</div>
                    </div>
                </div>
                <!-- END Post -->
            </div>

        </div>
        <!-- END Panel body -->

    </div>
    <!-- END Panel -->

</template>

<script>

export default {
    //
}

</script>
