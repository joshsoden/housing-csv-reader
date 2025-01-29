<script setup>
    import { ref } from 'vue';
    const props = defineProps(["title", "initial", "first_name", "last_name"]);
</script>

<template>
    <div class="card-container">
        <div class="homeowner-card">
            <img src="https://placehold.co/100"/>
            <p><b>Title:</b> {{ title }}</p>
            <p><b>Initial:</b> {{ initial }}</p>
            <p><b>First name:</b> {{ first_name }}</p>
            <p><b>Last name:</b> {{ last_name }}</p>
        </div>
    </div>
</template>