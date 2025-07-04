<template>
    <div class="rover-form">
        <h2>Mars rover mission</h2>
        <form>
            <div>
                <label>Initial position (x, y)</label>
                <input type="number" placeholder="X" required>
                <input type="number" placeholder="Y" required>
            </div>
            <div>
                <label>Direction: </label>
                <select required>
                    <option value="N">North</option>
                    <option value="E">East</option>
                    <option value="S">South</option>
                    <option value="W">West</option>
                </select>
            </div>
            <div>
                <label>Commands</label>
                <input type="text" placeholder="frflf" required>
            </div>
            <div>
                <label>Obstacles</label>
                <input type="text" placeholder="2,2;5,5" required>
            </div>
            <button type="submit">Start mission</button>
        </form>
    </div>
</template>
<script setup>


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