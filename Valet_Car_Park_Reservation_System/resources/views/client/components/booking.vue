<template>
    <div class="d-flex justify-content-center mt-3 border-bottom container">
      <h2>Reservation</h2>
    </div>
    <div class="centered-content">
      <div class="container">
        <div class="row">
          <div class="col-md-3 mb-3">
            <label for="parkingLotSelect" class="form-label">Parking Lot ID</label>
            <select v-model="selectedParkingLot" class="form-select" id="parkingLotSelect">
              <option value="">All</option>
              <!-- Populate with parking lot IDs -->
              <option v-for="parkingLot in parkingLots" :value="parkingLot.parking_lot_id" :key="parkingLot.parking_lot_id">{{ parkingLot.parking_lot_id }}</option>
            </select>
          </div>
          <div class="col-md-3 mb-3">
            <label for="dateInput" class="form-label">Date</label>
            <input v-model="selectedDate" type="date" class="form-control" id="dateInput" @change="craeteNewDate">
          </div>
          <div class="col-md-3 mb-3">
            <label for="startTimeInput" class="form-label">Start Time: </label>
            <div>
                <el-time-select
                    v-model="selectedStartTime"
                    :max-time="selectedEndTime"
                    class="mr-4"
                    placeholder="Start time"
                    start="08:00"
                    step="01:00"
                    end="17:00"
                />
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="endTimeInput" class="form-label">End Time  :</label>
            <div>
                <el-time-select
                    v-model="selectedEndTime"
                    :min-time="selectedStartTime"
                    placeholder="End time"
                    start="09:00"
                    step="01:00"
                    end="17:00"
                />
            </div>
          </div>
        </div>
      </div>

      <!-- Similar dropdowns for Date, Start Time, and End Time -->

      <div class="d-flex justify-content-center">
        <button @click="filterSpaces" class="btn btn-primary" :disabled="!selectedDate || !selectedStartTime || !selectedEndTime">Filter</button>
      </div>

      <div class="d-flex justify-content-center mt-3 border-bottom">
          <h2>Available Parking Space</h2>
      </div>

      <div class="d-flex justify-content-center mt-3">

        <button
          v-for="space in groupedFilteredSpaces"
          :key="space.parking_space_id"
          :class="['btn', 'btn-success', 'm-1', { 'btn-primary': space.parking_space_id === selectedSpaceId }]"
          @click="selectSpace(space.parking_space_id)"
        >
          {{ space.parking_space_id }}
        </button>
      </div>

      <div class="d-flex justify-content-center mt-3" style="margin-top: 20px;" v-if="selectedSpaceId">
        <div class="card-body card shadow">
          <form v-if="selectedSpaceId" @submit.prevent="bookParkingSpace">
              <div class="mb-3">
                  <label for="carPlateInput" class="form-label">Car Plate Number</label>
                  <input v-model="carPlate" type="text" class="form-control" id="carPlateInput" required>
              </div>
              <div class="mb-3">
                  <label for="emailInput" class="form-label">Email</label>
                  <input v-model="email" type="email" class="form-control" id="emailInput" required>
              </div>
              <div class="d-grid">
                  <button type="submit" class="btn btn-primary">Book</button>
              </div>
          </form>
        </div>
      </div>

    </div>
  </template>

  <script>
  import jsPDF from 'jspdf';
  import QRCode from 'qrcode';
  import axios from "axios";

  export default {
    data() {
      return {
        parkingLots: [],

        spaces: [],

        groupedFilteredSpaces: [],

        selectedParkingLot: "",
        selectedDate: null,
        selectedStartTime: null, //hold filter option
        selectedEndTime: null,
        selectedSpaceId: null,
        // Other filter properties (date, start time, end time)

        carPlate: "", //user submit data
        email: "",

      };
    },

    mounted(){
      this.fetchParkingLots();
      this.fetchSpaces();
    },

    methods: {

      async fetchParkingLots(){
        try{
          const response = await axios.get('/api/parkingLot/allId');
          this.parkingLots = response.data;
          console.log(this.parkingLots)

        }catch(error){
          console.error("error get parking lot:",error);
        }
      },

      async fetchSpaces(){
        try{
          const response = await axios.get('/api/parkingSpace/allData');
          this.spaces = response.data;
          console.log(this.spaces)
        }catch(error){
          console.log("error get parking space data:",error)
        }
      },

    /*  async craeteNewDate() {
          if (!this.selectedDate) {
              return;
          }

          try {
              await axios.post('/api/spaces/create-for-date', {
                  selectedDate: this.selectedDate
              });

              // After creating spaces, you might want to refetch the updated spaces data
              this.fetchSpaces();
          } catch (error) {
              console.error('Error creating spaces:', error);
          }
      },*/

      craeteNewDate(){
        const currentDate = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format
        this.groupedFilteredSpaces = this.groupSpacesByDate(this.spaces.filter(space => {
          let matches = true;
          if (this.selectedDate < currentDate || this.selectedDate && space.date !== this.selectedDate) {
            matches = false;
          }

          const parkingSpaceIDs = this.spaces.map(space => space.parking_space_id);

          const spaceIdMapping = {
              G0: parkingSpaceIDs,
              //G1: parkingSpaceIDs,  // Space IDs for parking lot 1
            // Add more mappings as needed
          };

          if (!this.spaces.some(space => space.date === this.selectedDate)) {
          const parkingLotSpaces = [];

          for (const parkingLot of this.parkingLots) {
            if (!this.selectedParkingLot || parkingLot.parking_lot_id === this.selectedParkingLot) {
              // Get the space IDs based on the parking lot ID
              const spaceIds = spaceIdMapping[parkingLot.parking_lot_id];

              if (spaceIds) {
                for (let hour = 8; hour <= 17; hour++) {
                  const slotStartTime = `${hour.toString().padStart(2, '0')}:00`;
                  const slotEndTime = `${(hour + 1).toString().padStart(2, '0')}:00`;

                  for (const spaceId of spaceIds) {
                    parkingLotSpaces.push({
                      parking_lot_id: parkingLot.parking_lot_id,
                      date: this.selectedDate,
                      start_time: slotStartTime,
                      end_time: slotEndTime,
                      status: 1,
                      parking_space_id: spaceId,
                      car_plate: null,
                      email: null
                    });
                    console.log(parkingLotSpaces);
                  }
                }
              }
            }
          }

            // Concatenate the new slots with the existing spaces array
            //this.spaces = this.spaces.concat(parkingLotSpaces);
            axios.post('/api/booking/',parkingLotSpaces);
            this.groupedFilteredSpaces = this.groupSpacesByDate(this.spaces);
          }
          return matches;
        }))
      },

      filterSpaces() {
        const currentDate = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format
        this.groupedFilteredSpaces = this.groupSpacesByDate(this.spaces.filter(space => {
          let matches = true;

          if (!this.selectedDate || !this.selectedStartTime || !this.selectedEndTime) {
            return false;
          }

          if (this.selectedParkingLot && space.parking_lot_id !== this.selectedParkingLot) {
            matches = false;
          }

          // Check if selectedDate is today or a future date
          if (this.selectedDate < currentDate || this.selectedDate && space.date !== this.selectedDate) {
            matches = false;
          }


          // Convert selected start and end times to Date objects for comparison
          const selectedStartTime = new Date(`${this.selectedDate} ${this.selectedStartTime}`);
          const selectedEndTime = new Date(`${this.selectedDate} ${this.selectedEndTime}`);

          // Find any booked time ranges for the selected space
          const bookedTimeRanges = this.spaces.filter(sp =>
            sp.parking_space_id === space.parking_space_id &&
            sp.date === this.selectedDate &&
            sp.status === 0
          );

          // Check for overlap with each booked time range
          for (const bookedRange of bookedTimeRanges) {
            const bookedStartTime = new Date(`${this.selectedDate} ${bookedRange.start_time}`);
            const bookedEndTime = new Date(`${this.selectedDate} ${bookedRange.end_time}`);

            if (
              (selectedStartTime >= bookedStartTime && selectedStartTime < bookedEndTime) ||
              (selectedEndTime > bookedStartTime && selectedEndTime <= bookedEndTime) ||
              (selectedStartTime <= bookedStartTime && selectedEndTime >= bookedEndTime)
            ) {
              matches = false;
              break; // No need to check further, space is not available
            }
          }

          console.log("Filtering space:", space.parking_space_id,space.start_time,space.end_time,space.date,space.status,space.car_plate,space.email);
          console.log("Matches:", matches);
          return matches;
        }));
      },

      groupSpacesByDate(spaces) {

        const grouped = {};
        for (const space of spaces) {
          const key = `${space.parking_space_id}-${space.date}`;
          if (!grouped[key]) {
            grouped[key] = {
              parkingLotId: space.parking_lot_id,
              date: space.date,
              id: space.parking_space_id,
              status: space.status,
              car_plate: space.car_plate,
              email: space.email
            };
          }
        }
        return Object.values(grouped);

      },

      selectSpace(spaceId) {
        console.log("Selected space:", spaceId);
        this.selectedSpaceId = spaceId;
        this.carPlate = ""; // Clear car plate input
        this.email = ""; // Clear email input
      },

      async generateAndDownloadInvoice(space) {
        const pdf = new jsPDF();
        pdf.text('Invoice', 10, 10);
        pdf.text(`Parking Space ID: ${space.parking_space_id}`, 10, 20);
        pdf.text(`Date: ${this.selectedDate}`, 10, 30);
        pdf.text(`Start Time: ${this.selectedStartTime}`, 10, 40);
        pdf.text(`End Time: ${this.selectedEndTime}`, 10, 50);
        pdf.text(`Car Plate: ${this.carPlate}`, 10, 60);
        pdf.text(`Email: ${this.email}`, 10, 70);
        pdf.text('Please show this invoice to the staff as a proof of booking.', 10, 90);

        // Generate and embed the QR code
        const youtubeUrl = 'https://www.youtube.com/watch?v=G1auYDCHO0k';
        const qrCodeCanvas = await QRCode.toCanvas(youtubeUrl);
        pdf.addImage(qrCodeCanvas, 'PNG', 10, 100, 50, 50);

        // Save the PDF and provide a link for the user to download
        const pdfBlob = pdf.output('blob');
        const pdfUrl = URL.createObjectURL(pdfBlob);
        const link = document.createElement('a');
        link.href = pdfUrl;
        link.download = `invoice_${space.parking_space_id}_${this.selectedDate}.pdf`;
        link.click();
      },

      async bookParkingSpace() {
        const selectedSpace = this.groupedFilteredSpaces.find(space => space.parking_space_id === this.selectedSpaceId);

        if (selectedSpace) {
          if (this.selectedDate && this.selectedStartTime && this.selectedEndTime) {
            console.log("Booking parking space:", selectedSpace.parking_space_id);
            console.log("Selected Date:", this.selectedDate);
            console.log("Selected Start Time:", this.selectedStartTime);
            console.log("Selected End Time:", this.selectedEndTime);
            console.log("Car Plate:", this.carPlate);
            console.log("Email:", this.email);
            console.log("Before booking - groupedFilteredSpaces:", this.groupedFilteredSpaces);

            const startTime = new Date(`${this.selectedDate} ${this.selectedStartTime}`);
            const endTime = new Date(`${this.selectedDate} ${this.selectedEndTime}`);

            // Calculate the number of hours between start and end times
            const hoursDiff = (endTime - startTime) / (1000 * 60 * 60);

            for (let i = 0; i < hoursDiff; i++) {
              const bookingStartTime = new Date(startTime.getTime() + i * 60 * 60 * 1000);
              const bookingEndTime = new Date(bookingStartTime.getTime() + 60 * 60 * 1000); // Assuming each slot is 1 hour

              // Find the space for each booking time slot
              const originalSpace = this.spaces.find(space =>
                space.parking_space_id === selectedSpace.parking_space_id &&
                space.date === this.selectedDate &&
                new Date(`${this.selectedDate} ${space.start_time}`) >= bookingStartTime &&
                new Date(`${this.selectedDate} ${space.end_time}`) <= bookingEndTime
              );

              if (originalSpace) {
                originalSpace.status = 0;
                originalSpace.car_plate = this.carPlate;
                originalSpace.email = this.email;
              }
              console.log(originalSpace)
            }

            // Update the status in the groupedFilteredSpaces array
            const groupedSpace = this.groupedFilteredSpaces.find(space => space.parking_space_id === selectedSpace.parking_space_id);
            if (groupedSpace) {
              groupedSpace.status = 0;
              groupedSpace.car_plate = this.carPlate;
              groupedSpace.email = this.email;

              try {
                const spaceToUpdate = this.spaces.find(space =>
                  space.id === selectedSpace.id &&
                  space.date === this.selectedDate &&
                  new Date(`${this.selectedDate} ${space.startTime}`) >= bookingStartTime &&
                  new Date(`${this.selectedDate} ${space.endTime}`) <= bookingEndTime
                );

                if (spaceToUpdate) {
                  spaceToUpdate.status = 0;
                  spaceToUpdate.car_plate = this.carPlate;
                  spaceToUpdate.email = this.email;

                  await axios.patch(`/api/${spaceToUpdate.parking_space_id}/'bookingStateUpdate/`, {
                    status: spaceToUpdate.status,
                    car_plate: spaceToUpdate.car_plate,
                    email: spaceToUpdate.email,
                  });

                  console.log("Updated data on server:", spaceToUpdate);
                }
              } catch (error) {
                console.error("Error updating data on server:", error);
              }
            }

            console.log("After booking - groupedFilteredSpaces:", this.groupedFilteredSpaces);
            console.log("Selected space:", selectedSpace);

            // Optional: You can perform additional actions here, such as sending data to a server.

            console.log("Parking space booked successfully:", selectedSpace);
            alert("Booked successfully, The invoice is downloaded automatically, PLease Check, Thank you.");
            this.generateAndDownloadInvoice(selectedSpace);
            // Clear the selected space and form inputs after booking
            this.selectedSpaceId = null;
            this.selectedDate = null;
            this.selectedStartTime = null;
            this.selectedEndTime = null;
            this.carPlate = "";
            this.email = "";
            this.groupedFilteredSpaces = [];

            // Optional: Display a success message or perform further actions.
          } else {
            console.log("Please select date and time");
          }
        }
      },

    },
  };
  </script>

  <style>

  .centered-content {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 50vh;
    }

  </style>
