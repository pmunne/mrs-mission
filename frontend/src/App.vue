<script setup>
import RoverForm from './components/RoverForm.vue'
</script>

<template>
    <div class="layout">
    <header>
        <h1>Mars mission</h1>
    </header>
    <main class="contaner">
      <router-view/>
    </main>
    <footer>
      <p>Pau Munné Martínez</p>
    </footer>
  </div>
</template>


<style>
.layout {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    background-color: #f0f0f0;
}

.container {
    max-width: 1000px;
    width: 100%;
    margin: 0 auto;
    padding: 0.5rem 1rem;
    background-color: white;
}


header {
    background-color: rgba(0, 123, 255, 0.8);
    color: white;
    padding: 1.5rem 1rem;
    text-align: center;
}
h1 {
        font-size: 2rem;
        font-weight: 600;
        letter-spacing: 1rem;
    }

main {
    flex: 1;
    display: flex;
    justify-content: center; 
    padding: 2rem 1rem;
    background-color: #f0f0f0;
}


footer {
    background-color: rgba(0, 123, 255, 0.4);
    color: white;
    text-align: center;
    padding: 1rem;
    font-size: 0.9rem;
}
</style>
