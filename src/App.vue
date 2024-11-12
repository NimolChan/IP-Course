<template>
  <div class="container">
    <div class="row1">
      <Category v-for="(categories, index) in categories"
      :key="index"
      :image="categories.image"
      :name="categories.name"
      :productCount="categories.productCount"
      :color="categories.color"
      />
    </div>
    <div class="row2">
      <Promotion v-for="(promotions,second) in promotions"
      :key="second"
      :image="promotions.image"
      :color="promotions.color"
      :title="promotions.title"
      />
    </div>
  </div>
</template>
<script>
import Category from './components/Category.vue';
import Promotion from './components/Promotion.vue';
import axis from 'axios';
export default{
  name: 'App',
  components: {
    Category,
    Promotion,
  },
  data(){
    return{
      categories:[
        // {img:'../image/buger.png', title:"Cake & Mile",item:14 +"items",bgColor:'#F2FCE4'},
        // {img:'../image/peach.png', title:"Peach",item:17 +"items", bgColor:'#FFFCEB'},
        // {img:'../image/kiwi.png', title:"Oganic Kiwi",item:68 +"items", bgColor:'#ECFFEC'},
        // {img:'../image/apple.png', title:"Red Apple",item:34 +"items", bgColor:'#FEEFEA'},
        // {img:'../image/snac.png', title:"Snack",item:25 +"items", bgColor:'#FFF3EB'},
        // {img:'../image/plum.png', title:"Black plum",item:10 +"items", bgColor:'#FFF3FF'},
        // {img:'../image/vegatable.png', title:"Vegetable",item:65 +"items", bgColor:'#F2FCE4'},
        // {img:'../image/headphone.png', title:"Headphone",item:33 +"items", bgColor:'#FFFCEB'},
        // {img:'../image/sack.png', title:"Cake & Mile",item:54 +"items", bgColor:'#F2FCE4'},
        // {img:'../image/orange.png', title:"Orange",item:63 +"items", bgColor:'#FFF3FF'},
      ],
<<<<<<< HEAD
      promotions:[
        // {bgImage:'../image/background1.jpg',bgColorSecond:'#F0E8D5',TittlePromotion:"Everyday Fresh & Clean with Our Products"},
        // {bgImage:'../image/background2.png',bgColorSecond:'#F3E8E8',TittlePromotion:"Make your Breakfast Healthy and Easy"},
        // {bgImage:'../image/background3.jpg',bgColorSecond:'#E7EAF3',TittlePromotion:"The best Organic Products Online"},
=======
      Promotions:[
        {bgImage:'../image/background1.jpg',bgColorSecond:'#F0E8D5',TittlePromotion:"Everyday Fresh & Clean with Our Products"},
        {bgImage:'../image/background2.png',bgColorSecond:'#F3E8E8',TittlePromotion:"Make your Breakfast Healthy and Easy"},
        {bgImage:'../image/background3.jpg',bgColorSecond:'#E7EAF3',TittlePromotion:"The best Organic Products Online"},
>>>>>>> b51ba2cef804076e622567d505ebab61a34e4379
      ]
    };
  },
  methods: {
      async getCategories() {
        const response = await axis.get('http://localhost:3000/api/categories')
        const categories = response.data;
        this.categories =categories;
      },
      async getPromotions() {
        const response = await axis.get('http://localhost:3000/api/promotions');
        const promotions = response.data;
        this.promotions = promotions;
      }
    },
    async mounted() {
      this.getCategories();
      this.getPromotions();
    }
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
  height: 30%;
  padding: 7px;
  display: flex;
  justify-content: space-between;
}
.row2{
  width: 100%;
  height: 70%;
  display: flex;
  justify-content: space-between;
}
</style>
