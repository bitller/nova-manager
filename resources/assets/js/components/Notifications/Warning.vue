<template>

    <div class="col-md-12 notification">

        <div class="col-md-2 text-center">
            <img src="/img/danger.svg" />
        </div>

        <div class="col-md-10">
            <div class="col-md-12">
                <h5><strong>{{ notification.title }}</strong></h5>
            </div>
            <div class="col-md-12">
                <span>
                    {{ notification.content }}
                </span>
            </div>

            <div v-if="notification.action_button_text && notification.action_button_url" class="col-md-12">
                <a href="{{ notification.action_button_url }}" target="_blank">
                    <div class="btn btn-primary pull-right read-more">{{ notification.action_button_text }}</div>
                </a>
            </div>
        </div>

    </div>

</template>

<script>

export default {

    props: ['notification'],

}

</script>
