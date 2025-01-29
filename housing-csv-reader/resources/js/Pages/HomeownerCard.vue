<script setup>
    import { ref } from 'vue';
    const props = defineProps({
        homeowner: {
            type: Object
        }
    });
</script>

<template>
    <div class="homeowner-card">
        <button>X</button>
        <img src="https://placehold.co/100"/>
        <p><b>Title:</b> {{ homeowner.title }}</p>
        <p><b>Initial:</b> {{ homeowner.initial }}</p>
        <p><b>First name:</b> {{ homeowner.first_name }}</p>
        <p><b>Last name:</b> {{ homeowner.last_name }}</p>
    </div>
</template>