<template>
    <div class="grid-image" v-if="imagesChoosed.length">
        <div v-for="image in imagesChoosed" :key="image.id" class="image-item">
            <img loading="lazy" class="image-item-image"
                :src="image.image" />
        </div>
    </div>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex';
    import store from '../store';

    export default {
        computed: {
            ...mapGetters([
                'imagesChoosed'
            ])
        }
    }
</script>

<style lang="scss" scoped>
    .grid-image {
        display: grid;
        grid-template-columns: repeat(9, 1fr);
        grid-gap: 15px;
        margin-bottom: 20px;
    }

    .image-item {
        width: 100%;
        height: 180px;
        border-radius: 7px;
        overflow: hidden;
        cursor: pointer;
        position: relative;

        &-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    }

    @media screen and (max-width: 1600px) {
        .grid-image {
            grid-template-columns: repeat(8, 1fr);
        }
    }

    @media screen and (max-width: 1500px) {
        .grid-image {
            grid-template-columns: repeat(7, 1fr);
        }
    }

    @media screen and (max-width: 1320px) {
        .grid-image {
            grid-template-columns: repeat(6, 1fr);
        }
    }

    @media screen and (max-width: 1120px) {
        .grid-image {
            grid-template-columns: repeat(5, 1fr);
        }
    }

    @media screen and (max-width: 767px) {
        .grid-image {
            grid-template-columns: repeat(3, 1fr);
        }
    }
</style>