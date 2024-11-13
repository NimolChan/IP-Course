<template>
  <div class="product-list">
    <h2>Popular Products</h2>
    <ul class="product-grid">
      <li v-for="product in product" :key="product.name" class="product-item">
        <div v-if="product.promotionAsPercentage > 0" class="badge discount">
          -{{ product.promotionAsPercentage }}%
        </div>
        <div v-else-if="product.isHot" class="badge hot">Hot</div>
        <div v-else-if="product.isSale" class="badge sale">Sale</div>

        <img :src="product.image" :alt="product.name" class="product-image" />


        <div class="product-details">
          <h4 class="product-brand">{{ product.brand }}</h4>
          <h3 class="product-name">{{ product.name }}</h3>
          <p class="product-size">{{ product.size }}</p>
          <div class="product-rating">
            <span>⭐ {{ product.rating }}</span>
          </div>
        </div>

   
        <div class="product-footer">
          <div class="product-price">
            <span v-if="product.promotionAsPercentage > 0" class="original-price">
              ${{ product.price.toFixed(2) }}
            </span>
            <span class="discounted-price">
              ${{ (product.price * (1 - product.promotionAsPercentage / 100)).toFixed(2) }}
            </span>
          </div>
          <button class="add-button">Add +</button>
        </div>
      </li>
    </ul>
  </div>
</template>
<script>
export default {
  name: 'Product',
  props: {
    products: {
      type: Array,
      required: true
    }
  }
};
</script>
<style scoped>
.product-list {
  padding: 1rem;
}

.product-list h2 {
  font-size: 1.5rem;
  font-weight: 600;
  color: #333;
  margin-bottom: 1rem;
}

.product-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  gap: 1rem;
}

.product-item {
  border: 1px solid #e0e0e0;
  border-radius: 8px;
  padding: 1rem;
  background-color: #fff;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  transition: transform 0.2s ease;
  position: relative;
}

.product-item:hover {
  transform: translateY(-5px);
}

.badge {
  position: absolute;
  top: 10px;
  left: 10px;
  padding: 5px 8px;
  border-radius: 5px;
  color: #fff;
  font-size: 0.75rem;
  font-weight: 600;
}

.discount {
  background-color: #28a745; /* Green for discount */
}

.hot {
  background-color: #ff4d4f; /* Red for hot items */
}

.sale {
  background-color: #ffa500; /* Orange for sale items */
}

.product-image {
  width: 100%;
  height: 150px;
  object-fit: cover;
  border-radius: 8px;
}

.product-details {
  text-align: center;
  margin-top: 1rem;
}

.product-brand {
  font-size: 0.85rem;
  color: #888;
  margin-bottom: 0.25rem;
}

.product-name {
  font-size: 1rem;
  font-weight: 600;
  color: #333;
  margin: 0.25rem 0;
}

.product-size {
  font-size: 0.85rem;
  color: #666;
}

.product-rating {
  font-size: 0.85rem;
  color: #ffa500; /* Star color */
}

.product-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 1rem;
}

.product-price {
  font-size: 1rem;
  font-weight: 600;
  color: #28a745;
}

.original-price {
  text-decoration: line-through;
  font-size: 0.85rem;
  color: #999;
  margin-right: 0.5rem;
}

.discounted-price {
  color: #28a745;
  font-weight: bold;
}

.add-button {
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 5px 10px;
  font-size: 0.85rem;
  cursor: pointer;
  transition: background-color 0.3s;
}

.add-button:hover {
  background-color: #0056b3;
}
</style>


