<template>
    <div class="rover-form">
        <h2>Mars rover mission</h2>
        <form @submit.prevent="startMission" > 
            <div v-if="loading">Starting mission...</div>
            <div v-if="error" class="error">{{ error }}</div> 
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
                <input v-model="obstacles" type="text" placeholder="2,2;5,5">
            </div>
            <button type="submit">Start mission</button>
        </form>
        <div v-if="result" class="result">
            <h3>Mission result</h3>
            <pre>{{ result }}</pre>
        </div>
    </div>
</template>
<script setup>
import {ref} from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()

const initialPosition = ref([0,0])
const direction = ref('N')
const commands = ref('')
const obstacles = ref('')

const loading = ref(false)
const error = ref(null)
const result = ref(null)


const startMission = async () => {
    loading.value = true
    error.value = null
    result.value = null

    const data = {
        initial_position: initialPosition.value,
        direction: direction.value,
        commands: commands.value,
        obstacles: orderObstacles(obstacles.value),
    }

    try {
        const response = await fetch('http://localhost:8080/api/rover/start', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data),

        })
        if(!response.ok) {
            throw new Error('Failed to start mission')
        }
        const responseData= await response.json()
        if(responseData.obstacle_found) {
            error.value = `Obstacle found at position [${responseData.stopped_position.join(', ')}]`
            return
        }


        localStorage.setItem('missionData', JSON.stringify({
            config: data,
            result: responseData,
        }))

        result.value = responseData

        router.push({ name: 'mission-control' })
    }catch (err) {
        error.value = err.message || 'An error occurred'
    }finally {
        loading.value = false   
    }
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
.result {
    background: #f9f9f9;
    padding: 1rem;
    border: 1px solid #ccc; 
    margin-top: 1rem;
}

.error {
    color: red;
    margin: 1rem 0;
}

</style>