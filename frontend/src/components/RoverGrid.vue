<template>
    <div class="grid">
        <div v-for="y in grid" :key="'row '+y" class="row">
            <div v-for="x in grid" :key="'col '+x" class="col" :class="{
                    rover: roverAt(centerX + x - half - 1, centerY + (half - y + 1)),
                    obstacle: obstaclesAt(centerX + x - half - 1, centerY + (half - y + 1)),
                    path: path(centerX + x - half - 1, centerY + (half - y + 1))
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

const grid = 11
const half = Math.floor(grid / 2)

const centerX = computed(() => props.position[0])
const centerY = computed(() => props.position[1])

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
        background-color:blue !important;
    }

    .col.obstacle {
        background-color: black;
    }
    .col.path {
        background-color: lightblue;
    }


</style>