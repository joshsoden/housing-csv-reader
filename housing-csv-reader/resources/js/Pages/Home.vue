<template>
    <header>
        <div class="flex vertical center">
            <img src="images/logo.png"/>
        </div>
    </header>
    <main>
        <div class="flex vertical space-around">
            <input type="file" accept=".csv" @change="handleFileUpload" id="file-input"/>
            <button :disabled="isDisabled" @click="handleButtonClick" :class="{ 'disabled': isDisabled }">Import list from .csv file</button>
        </div>
    </main>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            isDisabled: true
        }
    },
    methods: {
        handleFileUpload: function() {
            this.setIsDisabled(false);
        },
        setIsDisabled: function(bool) {
            this.isDisabled = bool;
        },
        handleButtonClick: function() {
            if(!this.isDisabled) {
                this.submitForm();
            }
        },
        submitForm: function() {
            console.log("submitForm() called");

            let formData = new FormData();
                formData.append("file", document.querySelector('#file-input').files[0]
            );

            console.log(formData);

            axios.post('/submit', formData, { 
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then((res) => {
                console.log("Retrieved");
                console.log(res);
            });
        }
    }
}
</script>
