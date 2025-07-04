<template>
    <div class="mission-control">
        <h2>Rover controls</h2>
        <RoverStatus :position="position" :direction="direction"/>
        <RoverGrid :position="position" :obstacles="obstacles" :path="path"/>
        <RoverControls @command="handleCommand"/>
        <button @click="resetMission" class="reset-button">Restart</button>
    </div>
</template>
<script setup>
import RoverStatus from '../components/RoverStatus.vue'
import RoverGrid from '../components/RoverGrid.vue' 
import RoverControls from '../components/RoverControls.vue'
import { ref } from 'vue';
import { useRouter } from 'vue-router'

const router = useRouter()
const resetMission = () => {
    if(confirm('Are you sure you want to restart the mission?')) {
        localStorage.removeItem('missionData')
        router.push({name: 'home'})
    }
}

const missionData = JSON.parse(localStorage.getItem('missionData') || '{}')


const position = ref(missionData.result?.final_position || [0, 0])
const direction = ref(missionData.result?.direction || 'N')
const obstacles = ref(missionData.config?.obstacles || [])
const path = ref(missionData.result?.path || [position.value])

const handleCommand = async (command) => {
    const data = {
        initial_position: position.value,
        direction: direction.value,
        commands: command,
        obstacles: obstacles.value
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
            throw new Error('Command failed')
        }
        const responseData= await response.json()
        position.value = responseData.final_position
        direction.value = responseData.direction
        path.value.push([...responseData.final_position])
        localStorage.setItem('missionData', JSON.stringify({
            config: {
                initial_position: missionData.config.initial_position, 
                direction: responseData.direction,
                obstacles: obstacles.value,
                commands: missionData.config.commands + command,
            },
            result: {
                final_position: responseData.final_position,
                direction: responseData.direction,
                obstacle_found: responseData.obstacle_found,
                stopped_position: responseData.stopped_position,
                path: path.value,
            }
        }))

    }catch(err) {
        console.error('Error command' + err.message)
    }
}

</script>

<style scoped>
    .reset-button {
        margin-top: 1rem;
        background-color: red;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 0.4px;
        cursor: pointer;
    }

    .reset-button:hover {
        background-color: darkred;
    }

    .mission-control {
        max-width: 700px;
        margin: 2rem auto;
        padding: 1rem;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: white;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        text-align: center;
    }
</style>