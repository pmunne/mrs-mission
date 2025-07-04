<template>
    <div class="status">
        <p>Position: {{ position[0] }}, {{ position[1] }}</p>
        <p>Direction: {{ direction }}</p>   
    </div>
</template>
<script setup>
const props = defineProps({
    position: {
        type: Array,
        required: true
    },
    direction: {
        type: String,
        required: true
    },
})

</script>