<template>
    <div class="modal fade bd-example-modal-lg" id="modal-image" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-0 pb-0">
                    <h4 class="modal-title">Chọn ảnh</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="choose-file" @click="chooseFile">
                        <div class="choose-file__message">
                            <i class="fas fa-cloud-upload"></i>
                            <p>Thêm ảnh vào thư viện</p>
                        </div>
                        <input @change="getFileAndUpload" type="file" accept="image/*" class="d-none" 
                            name="file" ref="image" id="choose-image">
                    </div>

                    <h4 class="my-3 text-muted">Ảnh của bạn</h4>

                    <ImageLibrary @chooseImage="chooseImage" :images="libraries"></ImageLibrary>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import { mapActions, mapGetters } from 'vuex';
    import store from '../store';

    export default {
        data: function() {
            return {
            }
        },
        created() {
            this.getLibraries();
        },
        methods: {
            ...mapActions([
                'getLibraries',
            ]),
            chooseFile: function() {
                $('#choose-image').click();
            },
            chooseImage(image) {
                let index = this.libraries.indexOf(image);
                let status = image.isChoosed;

                let newLibraries = [
                    ...this.libraries.slice(0, index),
                    {
                        ...image, isChoosed: !status
                    },
                    ...this.libraries.slice(index + 1),
                ];

                store.commit('setLibraries', newLibraries);

                // get all image choosed on state
                let imagesChoosed = newLibraries.filter(item => item.isChoosed);
                store.commit('setImagesChoosed', imagesChoosed);
            },
            getFileAndUpload() {
                store.commit('setLoadding');
                let file = this.$refs.image.files[0];
                let formData = new FormData();
                let url = '/admin/uploadFile';
                formData.append('file', this.$refs.image.files[0]);

                axios.post(url, formData, { headers: {'Content-Type': 'multipart/form-data'} })
                .then(res => {
                    if (res.status == 200) {
                        let resImage = res.data.data;

                        let newLibraries = [
                            resImage,
                            ...this.libraries.slice(0),
                        ];

                        store.commit('setLibraries', newLibraries);
                        store.commit('setLoadding');
                    }
                }).catch(err => {
                    Swal.fire({
                        title: 'Lỗi khi thêm vào thư viện!',
                        icon: "error"
                    });
                });
            }
        },
        computed: {
            ...mapGetters([
                'libraries', 'loadding', 'imagesChoosed'
            ])
        }
    }
</script>

<style lang="scss" scoped>
    .choose-file {
        width: 100%;
        border: 2px dashed #dbe3e8;
        transition: background-color .2s linear;
        cursor: pointer;

        &__message {
            padding: 20px 10px 10px;
            text-align: center;

            i {
                font-size: 2rem;
            }

            p {
                margin-top: 5px;
                font-size: 1.1rem;
                color: #606266;
            }
        }

        &:hover {
            background-color: #f6f6f6;
        }
    }      

    @media (min-width: 1300px) {
        .modal-lg {
            max-width: 1200px;
        }
    }

    @media (min-width: 1900px) {
        .modal-lg {
            max-width: 1450px;
        }
    }

    @media (min-width: 2100px) {
        .modal-lg {
            max-width: 1650px;
        }
    }
</style>