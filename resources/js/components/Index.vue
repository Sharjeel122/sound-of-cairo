<template>
    <div id="Header">
        <Header/>
        <HeroSection/>
        <FeaturedWalkthroughs/>
        <SectionSeperator/>
        <FeaturedSoundCategories/>
        <SectionSeperator/>
        <ExploreSoundsBy/>
        <SectionSeperator/>
        <Footer/>
    </div>
</template>

<script>
import Header from './Header.vue';
import Footer from './Footer.vue';
import HeroSection from "./HeroSection";
import FeaturedWalkthroughs from "./FeaturedWalkthroughs";
import SectionSeperator from "./SectionSeperator";
import FeaturedSoundCategories from "./FeaturedSoundCategories";
import ExploreSoundsBy from "./ExploreSoundsBy";
export default {
    name: "Index",
    components: {
        ExploreSoundsBy,
        FeaturedSoundCategories,
        SectionSeperator,
        FeaturedWalkthroughs,
        Header,
        HeroSection,
        Footer
    },

}
</script>

<style scoped>

</style>
