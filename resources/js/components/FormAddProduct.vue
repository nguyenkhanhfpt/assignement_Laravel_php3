<template>
    <div>
        <div v-if="loadding" class="line-loading"></div>
        <form action="" method="POST" enctype="multipart/form-data" class="mt-2">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="name_product">Tên sản phẩm</label>
                        <input type="text" class="form-control" name="name_product" id="name_product" 
                            placeholder="Nhập tên sản phẩm">
                        <small class="form-text text-danger">
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="id_category">Tên danh mục</label>
                        <select class="form-control" id="id_category" name="id_category">
                        </select>
                        <small class="form-text text-danger">
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="price_product">Giá sản phẩm</label>
                        <input type="text" class="form-control" name="price_product" id="price_product" 
                        placeholder="Nhập giá của sản phẩm">
                        <small class="form-text text-danger">
                        </small>
                    </div>

                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="sale">Giảm giá</label>
                        <input type="text" class="form-control" name="sale" id="sale" 
                        placeholder="Giảm giá cho sản phẩm">
                    </div>
                    <div class="form-group">
                        <label for="quantity_product">Số lượng sản phẩm</label>
                        <input type="text" class="form-control" name="quantity_product" id="quantity_product" 
                        placeholder="Số lượng sản phẩm">
                        <small class="form-text text-danger">
                        </small>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="img_product">Ảnh sản phẩm</label>
                                <button type="button" class="d-block btn btn-primary" 
                                    data-toggle="modal" data-target="#modal-image">
                                    Chon anh
                                </button>
                            </div>
                        
                            <small class="form-text text-danger">
                            </small>
                        </div>
                    </div>
                </div>

            </div>

            <ImageChoosed></ImageChoosed>

            <div class="form-group">
                <label for="decscription">Mô tả sản phẩm</label>
                <textarea class="form-control" id="decscription" rows="5" name="decscription"></textarea>
                <small class="form-text text-danger">
                </small>
            </div>

            <div class="custom-control custom-checkbox mr-sm-2 mb-3">
                <input type="checkbox" class="custom-control-input" name="nomination" id="nomination">
                <label class="custom-control-label" for="nomination">Đề cử sản phẩm</label>
            </div>

            <button type="submit" class="btn btn-primary">Thêm mới</button>
            <a class="btn btn-primary" href="">Danh sách sản phẩm</a>
        </form>

        <ModalImage></ModalImage>
    </div>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex';
    import store from '../store';

    export default {
        components: ['ImageChoosed'],
        methods: {
        },
        computed: {
            ...mapGetters([
                'loadding'
            ])
        }
    }
</script>

<style lang="scss">
    .line-loading {
        width: 100%;
        height: 0.2rem;
        position: fixed;
        margin: 0 auto;
        left: 0;
        z-index: 9999;
        top: 0px;
    }

    .line-loading:before {
        content: "";
        position: absolute;
        right: auto;
        left: 0;
        height: 100%;
        background-color: var(--primary);
        animation: lineLoading 1s forwards infinite linear;
    }

    @keyframes lineLoading {
        0% {
            right: 100%;
        }

        50% {
            right: 0;
            left: 0;
        }

        100% {
            right: 0;
            left: 100%;
        }
    }
</style>