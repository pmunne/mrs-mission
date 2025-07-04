<template>
    <div class="mission-control">
        <h2>Rover controls</h2>
        <RoverStatus :position="position" :direction="direction"/>
        <RoverGrid :position="position" :obstacles="obstacles" :path="path"/>
    </div>
</template>
<script setup>
import RoverStatus from '../components/RoverStatus.vue'
import RoverGrid from '../components/RoverGrid.vue'
import { ref } from 'vue';

const missionData = JSON.parse(localStorage.getItem('missionData') || '{}')
console.log('Mission data:', missionData)

const position = ref(missionData.result?.final_position || [0, 0])
const direction = ref(missionData.result?.direction || 'N')
const obstacles = ref(missionData.config?.obstacles || [])
const path = ref(missionData.result?.path || [position.value])

</script>