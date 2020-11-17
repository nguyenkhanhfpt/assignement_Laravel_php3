<template>
    <div>
        <div v-if="loadding" class="line-loading"></div>
        <form @submit.prevent="updateProduct" id="form-add-product" action="" method="POST" enctype="multipart/form-data" class="mt-2">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="name_product">Tên sản phẩm</label>
                        <input 
                            type="text" class="form-control" 
                            name="name_product" id="name_product" 
                            placeholder="Nhập tên sản phẩm" 
                            v-model="form.name_product" 
                            :class="{ 'is-invalid': submited && $v.form.name_product.$error }"
                        >
                        <div v-if="submited && !$v.form.name_product.required" class="invalid-feedback">
                            Tên sản phẩm không được để trống
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_category">Tên danh mục</label>
                        <multiselect v-model="form.category_id" label="name" track-by="id" 
                            :options="categories" :taggable="true">
                        </multiselect>
                    </div>

                    <div class="form-group">
                        <label for="color_product">Chọn màu sản phẩm</label>
                        <multiselect v-model="form.colors" placeholder="Tìm kiếm màu" label="name" track-by="id" 
                            :options="colors" :multiple="true" :close-on-select="false" >
                        </multiselect>
                    </div>

                    <div class="form-group">
                        <label for="price_product">Giá sản phẩm</label>
                        <input 
                            type="number" min="0" class="form-control" 
                            name="price_product" id="price_product" 
                            placeholder="Nhập giá của sản phẩm" 
                            v-model="form.price_product"
                            :class="{ 'is-invalid': submited && $v.form.price_product.$error }"
                        >
                        <div v-if="submited && !$v.form.price_product.required" class="invalid-feedback">
                            Giá sản phẩm không được để trống
                        </div>
                    </div>

                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="sale">Giảm giá</label>
                        <input type="number" min="0" class="form-control" name="sale" id="sale" 
                            placeholder="Giảm giá cho sản phẩm" v-model="form.sale">
                    </div>
                    <div class="form-group">
                        <label for="quantity_product">Số lượng sản phẩm</label>
                        <input type="number" min="0" class="form-control" 
                            name="quantity_product" 
                            id="quantity_product" 
                            placeholder="Số lượng sản phẩm" 
                            v-model="form.quantity_product"
                            :class="{ 'is-invalid': submited && $v.form.quantity_product.$error }"
                        >
                        <div v-if="submited && !$v.form.quantity_product.required" class="invalid-feedback">
                            Số lượng sản phẩm không được để trống
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="color_product">Chọn size cho sản phẩm</label>
                        <multiselect v-model="form.sizes" placeholder="Tìm kiếm size" label="size" track-by="id" 
                            :options="sizes" :multiple="true" :close-on-select="false">
                        </multiselect>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="img_product">Ảnh sản phẩm</label>
                                <button type="button" class="d-block btn btn-primary" 
                                    data-toggle="modal" data-target="#modal-image">
                                    <i class="fal fa-images"></i>
                                    Chon ảnh
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <ImageChoosed></ImageChoosed>

            <div class="form-group">
                <label for="decscription">Mô tả sản phẩm</label>
                <textarea 
                    class="form-control" v-model="form.decscription" 
                    id="decscription" rows="5" name="decscription"
                    :class="{ 'is-invalid': submited &&  $v.form.decscription.$error }"
                >
                </textarea>
                <div v-if="submited && !$v.form.decscription.required" class="invalid-feedback">
                    Mô tả sản phẩm không được để trống
                </div>
            </div>

            <div class="custom-control custom-checkbox mr-sm-2 mb-3">
                <input type="checkbox" v-model="form.nomination" class="custom-control-input" name="nomination" id="nomination">
                <label class="custom-control-label" :checked="form.nomination" for="nomination">Đề cử sản phẩm</label>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
            <a class="btn btn-primary" href="/admin/products">Danh sách sản phẩm</a>
        </form>

        <ModalImage></ModalImage>
    </div>
</template>

<script>
    import { required, between } from "vuelidate/lib/validators";
    import { mapActions, mapGetters } from 'vuex';
    import axios from 'axios';
    import store from '../store';

    export default { 
        props: ['id'],
        data: function() {
            return {
                categories: [],
                colors: [],
                sizes: [],
                submited: false,
                form: {
                    name_product: '',
                    price_product: '',
                    category_id: '',
                    sale: 0,
                    quantity_product: null,
                    decscription: '',
                    nomination: false,
                    colors: [],
                    sizes: [],
                    images: []
                }
            }
        },
        validations: {
            form: {
                name_product: { required },
                price_product: { required },
                category_id: { required },
                quantity_product: { required },
                decscription: { required },
            }
        },
        created() {
            axios.get('/api/categories')
            .then(res => {
                this.categories = res.data;
            });

            axios.get('/api/colors')
            .then(res => {
                this.colors = res.data;
            })

            axios.get('/api/sizes')
            .then(res => {
                this.sizes = res.data;
            })

            axios.get(`/admin/products/update/${this.id}`)
            .then(res => {
                let data = res.data;
                console.log(data)
                $('.card-title').text(data.name_product)
                this.form = {
                    name_product: data.name_product,
                    price_product: data.price_product,
                    category_id: data.category,
                    sale: 0,
                    quantity_product: data.quantity_product,
                    decscription: data.decscription,
                    nomination: data.nomination,
                    colors: data.colors,
                    sizes: data.sizes,
                }

                store.commit('setImagesChoosed', data.libraries);
            })
        },
        methods: {
            updateProduct() {
                store.commit('setLoadding');
                this.submited = true;

                this.$v.$touch();
                if (this.$v.$invalid) {
                    store.commit('setLoadding');
                    return;
                }

                if (this.imagesChoosed.length == 0) {
                    store.commit('setLoadding');

                    Swal.fire({
                        title: 'Phải chọn ít nhất 1 ảnh cho sản phẩm!',
                        icon: "error"
                    });
                    return;
                }

                this.form.images = this.imagesChoosed;
                this.submited = false;

                axios.patch(`/admin/products/update/${this.id}`, this.form)
                .then(res => {
                    if (res.status == 200) {
                        store.commit('setLoadding');

                        Swal.fire({
                            title: res.data.message,
                            icon: "success"
                        }).then(result => {
                            location.reload();
                        });
                    }
                }).catch(error => {
                    store.commit('setLoadding');

                    Swal.fire({
                        title: 'Lỗi khi cập nhật sản phẩm!',
                        icon: "error"
                    });
                })
            }
        },
        computed: {
            ...mapGetters([
                'loadding', 'imagesChoosed'
            ])
        }
    }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

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