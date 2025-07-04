<template>
    <div class="rover-form">
        <h2>Mars rover mission</h2>
        <form @submit.prevent="startMission" >  
            <div>
                <label>Initial position (x, y)</label>
                <input v-model="initialPosition[0]" type="number" placeholder="X" required>
                <input v-model="initialPosition[1]" type="number" placeholder="Y" required>
            </div>
            <div>
                <label>Direction: </label>
                <select v-model="direction" required>
                    <option value="N">North</option>
                    <option value="E">East</option>
                    <option value="S">South</option>
                    <option value="W">West</option>
                </select>
            </div>
            <div>
                <label>Commands</label>
                <input v-model="commands" type="text" placeholder="frflf" required>
            </div>
            <div>
                <label>Obstacles</label>
                <input v-model="obstacles" type="text" placeholder="2,2;5,5" required>
            </div>
            <button type="submit">Start mission</button>
        </form>
    </div>
</template>
<script setup>
import {ref} from 'vue'

const initialPosition = ref([0,0])
const direction = ref('N')
const commands = ref('')
const obstacles = ref('')


const startMission = () => {
    console.log({
        initialPosition: initialPosition.value,
        direction: direction.value,
        commands: commands.value,
        obstacles: orderObstacles(obstacles.value),
    })
}

//Order the obstacles to send them in the correct format
const orderObstacles = (input) => {
    return input.split(';').map(pair => pair.split(',').map(Number))
        .filter(([x,y]) => !isNaN(x) && !isNaN(y));
}



</script>

<style scoped>
.rover-form{
    max-width: 500px;
    margin: 0 auto;
    padding: 1rem;
    border: 1px solid #ccc;
}
.rover-form input,
.rover-form select {
    margin: 0.5rem 0;
    display: block;
}

</style>