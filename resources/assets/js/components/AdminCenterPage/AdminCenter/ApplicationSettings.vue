<template>

    <logo-text></logo-text>
    <allow-new-users></allow-new-users>
    <edit-landing-page-second-section></edit-landing-page-second-section>
    <edit-landing-page-third-section></edit-landing-page-third-section>
    <edit-landing-page-header-text></edit-langing-page-header-text>

</template>

<script>

import LogoText from '../../../components/AdminCenterPage/AdminCenter/ApplicationSettings/LogoText.vue';
import AllowNewUsers from '../../../components/AdminCenterPage/AdminCenter/ApplicationSettings/AllowNewUsers.vue';
import EditLandingPageHeaderText from '../../../components/AdminCenterPage/AdminCenter/ApplicationSettings/EditLandingPageHeaderText.vue';
import EditLandingPageSecondSection from '../../../components/AdminCenterPage/AdminCenter/ApplicationSettings/EditLandingPageSecondSection.vue';
import EditLandingPageThirdSection from '../../../components/AdminCenterPage/AdminCenter/ApplicationSettings/EditLandingPageThirdSection.vue';

export default {

    components: {
        'logo-text': LogoText,
        'allow-new-users': AllowNewUsers,
        'edit-landing-page-header-text': EditLandingPageHeaderText,
        'edit-landing-page-second-section': EditLandingPageSecondSection,
        'edit-landing-page-third-section': EditLandingPageThirdSection,
    }

}

</script>
