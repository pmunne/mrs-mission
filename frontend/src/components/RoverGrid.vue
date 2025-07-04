<template>
    <div class="grid">
        <div v-for="y in grid" :key="'row '+y" class="row">
            <div v-for="x in grid" :key="'col '+x" class="col" :class="{
                rover: roverAt(x-1, grid-y),obstacle: obstaclesAt(x-1, grid-y), path: path(x - 1, grid - y)
                 }"></div>
        </div>

    </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
    position: {
        type: Array,
        required: true
    },
    obstacles: {
        type: Array,
        default: () => []
    },
    path: {
        type: Array,
        default: () => []
    }
})

const grid = 10

const roverAt = (x, y) => props.position[0] === x && props.position[1] === y
const obstaclesAt = (x, y) => props.obstacles.some(([ox, oy]) => ox === x && oy === y)
const path = (x,y) =>  props.path.some(([px, py]) => px === x && py === y)

</script>

<style scoped>
    .grid {
        display: flex;
        flex-direction: column;
        border: 2px solid #333;
        margin: 1rem 0;
        max-width: 500px;
    }

    .row {
        display: flex;
    }
    .col {
        width: 30px;
        height: 30px;
        border: 1px solid #ccc;
        background-color: orangered;
    }

    .col.rover {
        background-color:blue;
    }

    .col.obstacle {
        background-color: black;
    }
    .cel.path {
        background-color: lightblue;
    }


</style>