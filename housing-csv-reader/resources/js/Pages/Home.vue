<template>
    <header>
        <div class="flex vertical center">
            <img src="images/logo.png"/>
        </div>
    </header>
    <main>
        <div class="flex vertical space-around">
            <input type="file" accept=".csv" @change="handleFileUpload"/>
            <button :disabled="isDisabled" :class="{ 'disabled': isDisabled }">Import list from .csv file</button>
        </div>
    </main>
</template>

<script>
export default {
    data() {
        return {
            isDisabled: true,
        }
    },
    methods: {
        handleFileUpload: function() {
            this.setIsDisabled(false);
        },
        setIsDisabled: function(bool) {
            this.isDisabled = bool;
        }
    }
}
</script>
