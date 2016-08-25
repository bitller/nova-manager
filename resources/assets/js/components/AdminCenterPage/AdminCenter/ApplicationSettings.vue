<template>

    <div class="blabla">
    <logo-text></logo-text>
    <allow-new-users></allow-new-users>
    <edit-landing-page-header-text></edit-langing-page-header-text>
        <edit-landing-page-second-section></edit-landing-page-second-section>
        <edit-landing-page-third-section></edit-landing-page-third-section>
        <edit-landing-page-fourth-section></edit-landing-page-fourth-section>
        <edit-landing-page-fifth-section></edit-landing-page-fifth-section>
    <edit-landing-page-sixth-section></edit-ladning-page-sixth-section>
        <edit-landing-page-seventh-section></edit-landing-page-seventh-section>
    </div>

</template>

<script>

import LogoText from '../../../components/AdminCenterPage/AdminCenter/ApplicationSettings/LogoText.vue';
import AllowNewUsers from '../../../components/AdminCenterPage/AdminCenter/ApplicationSettings/AllowNewUsers.vue';
import EditLandingPageHeaderText from '../../../components/AdminCenterPage/AdminCenter/ApplicationSettings/EditLandingPageHeaderText.vue';
import EditLandingPageSecondSection from '../../../components/AdminCenterPage/AdminCenter/ApplicationSettings/EditLandingPageSecondSection.vue';
import EditLandingPageThirdSection from '../../../components/AdminCenterPage/AdminCenter/ApplicationSettings/EditLandingPageThirdSection.vue';
import EditLandingPageFourthSection from '../../../components/AdminCenterPage/AdminCenter/ApplicationSettings/EditLandingPageFourthSection.vue';
import EditLandingPageFifthSection from '../../../components/AdminCenterPage/AdminCenter/ApplicationSettings/EditLandingPageFifthSection.vue';
import EditLandingPageSixthSection from '../../../components/AdminCenterPage/AdminCenter/ApplicationSettings/EditLandingPageSixthSection.vue';
import EditLandingPageSeventhSection from '../../../components/AdminCenterPage/AdminCenter/ApplicationSettings/EditLandingPageSeventhSection.vue';

export default {

    components: {
        'logo-text': LogoText,
        'allow-new-users': AllowNewUsers,
        'edit-landing-page-header-text': EditLandingPageHeaderText,
        'edit-landing-page-second-section': EditLandingPageSecondSection,
        'edit-landing-page-third-section': EditLandingPageThirdSection,
        'edit-landing-page-fourth-section': EditLandingPageFourthSection,
        'edit-landing-page-fifth-section': EditLandingPageFifthSection,
        'edit-landing-page-sixth-section': EditLandingPageSixthSection,
        'edit-landing-page-seventh-section': EditLandingPageSeventhSection,
    }

}

</script>
