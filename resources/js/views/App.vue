<template>
    <div>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    name: 'app',

    props: ['counter'],

    data() {
        return {
            
        }
    },

    created() {
        console.log(this.counter);
        
    }
}
</script>