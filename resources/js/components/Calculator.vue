<template>
    <div class="d-flex justify-content-center " :style="{ 'margin-top': 2 + 'rem' }">
      <div>
        <div>
          <h1 class="text-center mb-3">InsulCalc</h1>
        </div>
        <div>
          <div class="mb-3">
            <div>
              <label for="length">Length:</label>
            </div>
            <div class="form-inline">
              <input class="form-control mr-2" type="number" placeholder="Feet" id="length" v-model="lengthFt" />
              <input class="form-control mr-2" type="number" placeholder="Inches" id="length" v-model="lengthIn" />
            </div>
          </div>
          <div class="mb-3">
            <div>
              <label for="width">Width:</label>
            </div>
            <div class="form-inline">
              <input class="form-control mr-2" type="number" placeholder="Feet" id="width" v-model="widthFt" />
              <input class="form-control mr-2" type="number" placeholder="Inches" id="width" v-model="widthIn" />
            </div>
          </div>
          <div class="mb-3">
            <div>
              <label for="height">Height:</label>
            </div>
            <div class="form-inline">
              <input class="form-control mr-2" type="number" placeholder="Feet" id="height" v-model="heightFt" />
              <input class="form-control mr-2" type="number" placeholder="Inches" id="height" v-model="heightIn" />
            </div>
          </div>
          <div class="mb-3">
            <div>
              <label for="rValue">R-Value:</label>
            </div>
            <select id="rValue" v-model="rValue">
              <option value="30">30</option>
              <option value="35">35</option>
              <option value="40">40</option>
              <option value="45">45</option>
              <option value="50">50</option>
              <option value="55">55</option>
              <option value="60">60</option>
            </select>
          </div>
  
  
          <button class="btn btn-primary" @click.prevent="submitData">Calculate</button>
  
          <div v-if="result">
            <h2>Insulation Requirements:</h2>
            <p>Volume Needed: {{ insulationNeeded.toFixed(2) }} cubic feet</p>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  
  export default {
    data() {
      return {
        heightFt: '',
        heightIn: '',
        widthFt: '',
        widthIn: '',
        lengthFt: '',
        lengthIn: '',
        rValue: '',
        result: false,
        area: 0,
        insulationNeeded: 0,
      };
    },
    methods: {
      submitData() {
  
        const data = {
          heightFt: this.heightFt,
          heightIn: this.heightIn,
          widthFt: this.widthFt,
          widthIn: this.widthIn,
          lengthFt: this.lengthFt,
          lengthIn: this.lengthIn,
          rValue: this.rValue,
        };
  
        // Send data to Laravel backend using an HTTP library like Axios
        axios.post('api/calculate', data)
          .then(response => {
            // Handle the response from the backend
            this.area = response.data.area;
            this.insulationNeeded = response.data.insulationNeeded;
            this.result = true;
          })
          .catch(error => {
            // Handle any error that occurred during the request
            console.error(error);
          });
      },
    },
  };
  </script>
  