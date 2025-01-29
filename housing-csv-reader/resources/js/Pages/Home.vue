<script setup>
    import HomeownerCard from './HomeownerCard.vue'
</script>

<template>
    <header>
        <div class="flex vertical center">
            <img src="images/logo.png"/>
        </div>
    </header>
    <main>
        <div class="flex vertical space-around">
            <input type="file" accept=".csv" ref="file" @change="handleFileUpload" id="file-input"/>
            <button :disabled="isDisabled" @click="handleButtonClick" :class="{ 'disabled': isDisabled }">Import list from .csv file</button>
        </div>
        <div>
            <div class="homeowner-container" v-if="csvPeople.length > 0">
                <HomeownerCard v-for="person in csvPeople"/>   

                <div class="flex center">
                    <button @click="handleHomeownerSubmission">Submit homeowner details</button>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            isDisabled: true,
            csvFile: null,
            csvPeople: [
                {
                    title: "Mr",
                    initial: "J",
                    first_name: "Joshua",
                    last_name: "Soden"
                }
            ],
        }
    },
    methods: {
        handleFileUpload: function() {
            this.setIsDisabled(false);
            this.csvFile = this.$refs.file.files[0];
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
            formData.append('csv_file', this.csvFile);

            axios.post('/submit', formData, {
                headers: { 'Content-Type': 'multipart/form-data' },
            })
            .then((res) => {
                this.csvPeople = res.data;
            });
        },
        handleHomeownerSubmission: function() {
            console.log("handleHomeownerSubmission() called!");

            let data = {
                homeowners: this.csvPeople
            };

            axios.post('/store', data, {
                headers: { 'Content-Type': 'application/json' },
            })
            .then((res) => {
                alert(res.data);
            });
        }
    }
}
</script>
