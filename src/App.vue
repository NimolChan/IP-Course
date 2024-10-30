<template>
  <div class="container">
    <div class="row1">
      <Category v-for="(products, index) in products"
      :key="index"
      :imgSrc="products.img"
      :title="products.title"
      :items="products.item"
      :bgColor="products.bgColor"
      />
    </div>
    <div class="row2">
      <Promotion v-for="(Promotions,second) in Promotions"
      :key="second"
      :bgImage="Promotions.bgImage"
      :bgColorSecond="Promotions.bgColorSecond"
      :TittlePromotion="Promotions.TittlePromotion"
      />
    </div>
  </div>
</template>
<script>
import Category from './components/Category.vue';
import Promotion from './components/Promotion.vue';
export default{
  name: 'App',
  components: {
    Category,
    Promotion,
  },
  data(){
    
    return{
      products:[
        {img:'../image/buger.png', title:"Cake & Mile",item:14 +"items",bgColor:'#F2FCE4'},
        {img:'../image/peach.png', title:"Peach",item:17 +"items", bgColor:'#FFFCEB'},
        {img:'../image/kiwi.png', title:"Oganic Kiwi",item:68 +"items", bgColor:'#ECFFEC'},
        {img:'../image/apple.png', title:"Red Apple",item:34 +"items", bgColor:'#FEEFEA'},
        {img:'../image/snac.png', title:"Snack",item:25 +"items", bgColor:'#FFF3EB'},
        {img:'../image/plum.png', title:"Black plum",item:10 +"items", bgColor:'#FFF3FF'},
        {img:'../image/vegatable.png', title:"Vegetable",item:65 +"items", bgColor:'#F2FCE4'},
        {img:'../image/headphone.png', title:"Headphone",item:33 +"items", bgColor:'#FFFCEB'},
        {img:'../image/sack.png', title:"Cake & Mile",item:54 +"items", bgColor:'#F2FCE4'},
        {img:'../image/orange.png', title:"Orange",item:63 +"items", bgColor:'#FFF3FF'},
      ],
      Promotions:[
        {bgImage:'../image/backgroundg1.jpg',bgColorSecond:'#F0E8D5',TittlePromotion:"Everyday Fresh & Clean with Our Products"},
        {bgImage:'../image/backfroundg2.png',bgColorSecond:'#F3E8E8',TittlePromotion:"Make your Breakfast Healthy and Easy"},
        {bgImage:'../image/background3.jpg',bgColorSecond:'#E7EAF3',TittlePromotion:"The best Organic Products Online"},
      ]
    };
  },
};
</script>

<style>
.container{
  width: 75rem;
  height: 35rem;
  background-color: white;
  padding: 1rem;
}
.row1{
  width: 100%;
  height: 31%;
  padding: 7px;
  display: flex;
  justify-content: space-between;
}
.row2{
  width: 100%;
  height: 69%;
  /* background-color: rgb(241, 246, 173); */
  display: flex;
  justify-content: space-between;
}
</style>
