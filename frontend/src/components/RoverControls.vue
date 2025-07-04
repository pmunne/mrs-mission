<template>
    <div class="controls">
        <label>Commands (f, l, r):</label>
        <input v-model="command" type="text" placeholder="frflf" required>

        <button @click="sendCommand" :disabled="!isValidCommand">Send</button>
        <p class="error">{{ err }}</p>
    </div>

</template>
<script setup>
import { ref, computed } from 'vue';

const emit = defineEmits(['command']);

const command = ref('');
const err = ref('');

const isValidCommand = computed(() => {
    return /^[frl]*$/.test(command.value);
});
const sendCommand = () => {
    const value = command.value.toLowerCase();
    if(!isValidCommand.value) {
        err.value= "Invalid command"
        return
    }

    emit('command', value);
    command.value = '';
}

</script>

<style scoped>
    .controls {
        margin-top: 1rem;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    input {
        margin: 0.5rem 0;
        padding: 0.5rem;
        font-size: 1rem;
    }

    button {
        padding: 0.5rem 1rem;
        font-weight: bold;
        cursor: pointer;
    }

    .error {
        margin-top: 0.5rem;
        font-size: 1rem;
        color: red;
    }

</style>