<template>
    <div class="your-image">
        <div class="grid-image">
            <div v-for="(image, index) in images" :key="index" class="image-item" 
                :class="image.isChoosed ? 'choosed' : ''" @click="clickImage(image)">
                <img loading="lazy" class="image-item-image"
                    :src="image.image" />
                <i :if="image.isChoosed" class="fas fa-check-circle tick-choosed"></i>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['images'],
    methods: {
        clickImage(image) {
            this.$emit('chooseImage', image);
        }
    }
}
</script>

<style lang="scss" scoped>
    .your-image {
        max-height: 610px;
        overflow-y: auto;

        &::-webkit-scrollbar {
            width: .5em;
        }

        &::-webkit-scrollbar-thumb {
            background-color: rgba(0,0,0,.2);
            border-radius: 5px;
        }
    }

    .grid-image {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;
        grid-gap: 15px;
    }

    .image-item {
        height: 190px;
        border-radius: 7px;
        overflow: hidden;
        cursor: pointer;
        position: relative;

        &-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        &.choosed {
            border: 2px solid #fb9678;

            .tick-choosed {
                position: absolute;
                top: 10px;
                right: 10px;

                color:  #fb9678;
                font-size: 1rem;
            }
        }  
    }

    @media screen and (max-width: 1300px) {
        .grid-image {
            grid-template-columns: 1fr 1fr 1fr;
        }
    }

    @media screen and (max-width: 767px) {
        .grid-image {
            grid-template-columns: 1fr 1fr;
        }
    }
</style>