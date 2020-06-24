<template>
    <div>

        <input type="text" placeholder="Title" v-model="product.title">

        <textarea name="content" id="" cols="30" rows="10" v-model="product.content"></textarea>

        <textarea name="description" id="" cols="30" rows="10" v-model="product.description"></textarea>

        <input type="number" placeholder="price" v-model="product.price">

        <input type="number" placeholder="compare_at_price" v-model="product.compare_at_price">

        <button @click="createProduct()" type="button">Click Me!</button>
    </div>
</template>

<script>
export default {

    data() {
        return {
            product:{
                'visibility' : 'public'
            },
        }
    },

    methods: {

        createProduct() {

            axios.post(`/products`,this.product)
            .then(response => {

            })
            .catch(e => {

            });

        }

    }
}
</script>