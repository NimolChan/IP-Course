<template>
  <div class="Header">
    <div class="menu">
      <ul>
        <li><router-link to="/page1" class="nav-button p-3">Page1</router-link></li>
        <li><router-link to="/page2" class="nav-button p-3">Page2</router-link></li>
        <li><router-link to="/page3" class="nav-button p-3">Page3</router-link></li>
      </ul>
    </div>
    <div class="allPage">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
</script>

<style>
  .Header {
    width: 100%;
    height: 5rem;
    background-color: aqua;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
  }

  .menu {
    width: 70%;
    height: 100%;
    background-color: burlywood;
    border: 1px solid black;
    display: flex;
    align-items: center;
    font-weight: bold;
    font-size: 1.5rem;
  }

  .allPage {
    width: 30%;
    height: 100%;
    background-color: rgb(144, 222, 135);
    border: 1px solid black;
    border-left: none;
  }

  .allPage ul {
    list-style: none;
    display: flex;
    align-items: center;
    justify-content: space-around;
    height: 100%;
    margin: 0;
    padding: 0;
  }

  ul li {
    text-decoration: none;
    font-size: 1.7rem;
  }

  .nav-button {
    text-decoration: none;
    color: black;
    transition: all 0.3s ease-in-out;
    border-radius: 5px;
    padding: 0.5rem 1rem;
  }
.router-link-active{
    color: red;
}

  </style>
