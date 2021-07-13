<template>
 <div>
  <div class="container mt-5">
   <div class="row w-100 justify-content-center align-items-center h-100 mt-5">
    <router-link to="/addrecipe">
     <div class="card mr-5 ">
      <img src="@/assets/images/add-recipe.jpg" alt="">
      <div class="text">
       <h5>ADD RECIPE</h5>
      </div>
     </div>
    </router-link>
    <router-link to="/listrecipe">
     <div class="card ml-4">
      <img src="@/assets/images/list-recipe.jpg" alt="">
      <div class="text">
       <h5>LIST OF RECIPES</h5>
      </div>
     </div>
    </router-link>
   </div>
  </div>
 </div>
</template>
<script>
export default {
 
}
</script>
<style>
.card {
 position: relative;
 min-height: 380px;
 max-width: 340px;
 border-radius: 10px;
 margin-top: 80px;
 transition: all 250ms ease-in-out;
}

.card img{
 min-height: 380px;
 width: 100%;
 height: 100%;
 border-radius: 10px;
 object-fit: cover;
 filter: brightness(40%);
 
}

.justify-content-center {
 justify-content: center;
}

.align-items-center {
 align-items: center;
}

.card .text {
 position: absolute;
 top: 50%;
 left: 0;
 width: 100%;
 transform: translateY(-50%);
 background: rgb(0, 0, 0);
 height: auto;
}

.card .text h5 {
 color: white;
 text-align: center;
 font-size: 2rem;
}

a .card:hover {
 transform: scale(1.05);
}
</style>