<template>
    <button class="shop-button">
        {{ buttonText }} <i class="bi bi-arrow-right"></i></button>
</template>

<script>
export default {
    // name: "Button",
        props: {
            buttonText: {
                type: String,
                Required: true,
            },
    },
}
</script>

<style  scoped>
    .shop-button{
        width: 100px;
        height: 30px;
        background-color: #3BB77E;
        font-size: 13px;
        color: white;
        margin-top: 45%;
        position: absolute;
        border: none;
        margin-left: 10%;
    }
    .shop-button:hover{
        background-color: #FDC040;
    }
</style>