<template>
  <div class="product-container">
    <div class="product-item">
      <div v-if="promotionAsPercentage > 0" class="badge discount">
        -{{ promotionAsPercentage }}%
      </div>
      <div v-else-if="isHot" class="badge hot">Hot</div>
      <div v-else-if="isSale" class="badge sale">Sale</div>

      <img :src="image" :alt="name" class="product-image" />

      <div class="product-details">
        <h4 class="product-brand">{{ brand }}</h4>
        <h3 class="product-name">{{ name }}</h3>
        <div class="product-rating">
          <span>⭐⭐⭐⭐ {{ rating }}</span>
        </div>
        <p class="product-size">{{ size }}</p>
      </div>

      <div class="product-footer">
        <div class="product-price">
          <span class="discounted-price">
            ${{ (price * (1 - promotionAsPercentage / 100)).toFixed(2) }}
          </span>
          <span v-if="promotionAsPercentage > 0" class="original-price">
            ${{ price.toFixed(2) }}
          </span>
        </div>
        <button class="add-button">Add +</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Product',
  props: {
    image: String,
    name: String,
    price: Number,
    size: String,
    rating: Number,
    promotionAsPercentage: Number,
    categoryId: Number,
    instock: Number,
    countSold: Number,
    group: String,
  },
};
</script>

<style scoped>
.product-container {
  display: flex;
  flex-direction: column;
  padding: 1rem;
  width: 250px; 
}

.product-item {
  width: 100%;
  height: 100%;
  border: 1px solid #e0e0e0;
  border-radius: 12px;
  padding: 1rem;
  background-color: #fff;
  position: relative;
  margin-bottom: 1rem;
}


.discounted-price {
  color: #4CAF50;
  font-weight: bold;
  font-size: 1.2rem;
}

.add-button {
  background-color: #2dd3af;
  color: #fff;
  border: none;
  border-radius: 6px;
  padding: 6px 10px;
  font-size: 0.9rem;
  cursor: pointer;
  transition: background-color 0.3s;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.badge {
  position: absolute;
  top: 10px;
  left: 0.4px;
  padding: 5px 7px;
  border-radius: 0 10px 10px 0 ;
  color: #fcfcfc;
  font-size: 0.6rem;
  font-weight: 600;
}

.discount {
  background-color: #28a745;
}

.hot {
  background-color: #ff4d4f;
}

.sale {
  background-color: #ffa500;
}

.product-image {
  width: 100%;
  height: 35%;
  object-fit: contain;
  border-radius: 5px;
  margin-bottom: 1rem;
  
}  

.product-details {
  text-align: left;
  margin-top: 1.5rem;
}

.product-brand {
  font-size: 0.85rem;
  color: #888;
  margin-bottom: 0.25rem;
}

.product-name {
  font-size: 0.78rem;
  font-weight: 600;
  color: #333;
  margin: 0.25rem;
}

.product-size {
  font-size: 0.85rem;
  color: #666;
  margin-bottom: 0.5rem;
}

.product-rating {
  font-size: 0.85rem;
  color: #ffa500;
  display: flex;
  align-items: center;
}

.product-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin: 2rem 0 1rem 0;
}

.product-price {
  font-size: 1rem;
  font-weight: 500;
  color: #28a745;
}

.original-price {
  text-decoration: line-through;
  font-size: 0.85rem;
  color: #999;
}
</style>
