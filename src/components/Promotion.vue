<template>

    <div  class="Promo" :style="{backgroundColor: Color}">
        <img :src="image" alt="">
        <h3>{{ title }}</h3>
        <Button @click="shopNow(Promotion)" :buttonText="'Show Now'"></Button>/>
    </div>
</template>


<script>
import Button from './Button.vue';
export default {
    name: "promotions",
    components:{
        Button,
    },
    props:{
        image:String,
        Color:String,
        title: String,

    },
    methods: {
        shopNow() {
            alert("Let's Shop: " + this.title);
        }
}
    }
</script>

<style scoped>
    .Promo {
        width: 23.5rem;
        height: 16rem;
        background-color: #f5f5f5; 
        margin-top: 2rem;
        border-radius: 15px;
        position: relative;
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .Promo img {
        width:auto;
        height: 40%;
        object-fit: contain;
        position: absolute;
        right: 10px;
        bottom: 10px;
    }
    .Promo:nth-child(1) {
        background-color: #f3e8d8;
    }
    .Promo:nth-child(2) {
        background-color: #fbe8f2; 
    }
    .Promo:nth-child(3) {
        background-color: #e5ecf0; 
    }

    .Promo h3 {
        color: black;
        font-size: 1.3rem;
        font-weight: 450;
        position: absolute;
        top: 15%;
        left: 10%;
        width: 50%;
    }
</style>
