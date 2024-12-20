<template>
    <header>
        <div class="flex vertical center">
            <img src="images/logo.png"/>
        </div>
    </header>
    <main>
        <div class="flex vertical space-around">
            <input type="file" accept=".csv" @change="handleFileUpload"/>
            <button class="disabled">Import list from .csv file</button>
        </div>
    </main>
</template>

<script>
export default {
    methods: {
        handleFileUpload: () => {
            alert("File has been uploaded!");
        }
    }
}
</script>
