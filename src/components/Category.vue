<template>
    <div class="cat" :style="{backgroundColor:color}">
        <div class="cat-img">
            <img :src="image" :alt="title">
        </div>
        <div class="cat-text">
            <h4>{{name }}</h4>
            <p>{{ productCount }}</p>
        </div>
    </div>
</template>

<script>



export default {
    name:"categories",
    props: {
        id: Number,
        image:String,
        name: String,
        productCount: String,
        color: String
    },

  };

</script>

<style  scoped>
    .cat{
        color: black;
        border-radius: 10px;
        border: 1px solid green;
        width: 6.5rem;
        height: 8.5rem;
    }
    .cat-img{
        width: 100%;
        height: 60%;
        border-radius: 10px;
    }
    .cat-img img{
        width: 100%;
        height: 100%;
    }
    .cat-text{
        width: 100%;
        height: 40%;
        border-radius: 10px;
        padding: 3px;
        
    }
    .cat-text h4{
        display: flex;
        justify-content: center;
    }
    .cat-text p{
        display: flex;
        justify-content: center;
        opacity: 0.8;
        font-size: 13px;
    }
</style>