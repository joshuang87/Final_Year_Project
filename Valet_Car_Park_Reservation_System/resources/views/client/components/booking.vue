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
              <option v-for="parkingLot in parkingLots" :value="parkingLot.id" :key="parkingLot.id">{{ parkingLot.id }}</option>
            </select>
          </div>
          <div class="col-md-3 mb-3">
            <!-- <label for="dateInput" class="form-label">Date</label>
            <input v-model="selectedDate" type="date" class="form-control" id="dateInput" @change="craeteNewDate"> -->
            <el-date-picker v-model="selectedDate"
                            type="date"
                            placeholder="Pick a day"
                            @change="craeteNewDate"
            />
          </div>
          <div class="col-md-3 mb-3">
            <!-- <label for="startTimeInput" class="form-label">Start Time</label>
            <select v-model="selectedStartTime" class="form-select" id="startTimeInput">
              <option value="">Any</option>
              <option value="08:00">08:00 AM</option>
              <option value="09:00">09:00 AM</option>
              <option value="10:00">10:00 AM</option>
              <option value="11:00">11:00 AM</option>
              <option value="12:00">12:00 PM</option>
              <option value="13:00">13:00 PM</option>
              <option value="14:00">14:00 PM</option>
              <option value="15:00">15:00 PM</option>
              <option value="16:00">16:00 PM</option>
              Add more time options as needed
            </select> -->
            <el-time-select v-model="selectedStartTime"
                            :max-time="selectedEndTime"
                            placeholder="Start Time"
                            start="08:00"
                            step="01:00"
                            end="22:00"
            />
          </div>
          <div class="col-md-3 mb-3">
            <!-- <label for="endTimeInput" class="form-label">End Time</label>
            <select v-model="selectedEndTime" class="form-select" id="endTimeInput">
              <option value="">Any</option>
              <option value="09:00">09:00 AM</option>
              <option value="10:00">10:00 AM</option>
              <option value="11:00">11:00 AM</option>
              <option value="12:00">12:00 PM</option>
              <option value="13:00">13:00 PM</option>
              <option value="14:00">14:00 PM</option>
              <option value="15:00">15:00 PM</option>
              <option value="16:00">16:00 PM</option>
              <option value="17:00">17:00 PM</option>
              Add more time options as needed
            </select> -->
            <el-time-select v-model="selectedEndTime"
                            :min-time="selectedStartTime"
                            placeholder="End Time"
                            start="08:00"
                            step="01:00"
                            end="22:00"
            />
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
          :key="space.id"
          :class="['btn', 'btn-success', 'm-1', { 'btn-primary': space.id === selectedSpaceId }]"
          @click="selectSpace(space.id)"
        >
          {{ space.id }}
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

  export default {
    data() {
      return {
        parkingLots: [
                        { id: 1 },
                        { id: 2 },
                     ],

        spaces: [
                    { parkingLotId: 1, date: "2023-08-21", startTime: "08:00", endTime: "09:00", status: "available", id: 101, car_plate: null, email: null },
                    { parkingLotId: 1, date: "2023-08-21", startTime: "09:00", endTime: "10:00", status: "available", id: 101, car_plate: null, email: null },
                    { parkingLotId: 1, date: "2023-08-21", startTime: "10:00", endTime: "11:00", status: "available", id: 101, car_plate: null, email: null },
                    { parkingLotId: 1, date: "2023-08-21", startTime: "11:00", endTime: "12:00", status: "available", id: 101, car_plate: null, email: null },
                    { parkingLotId: 1, date: "2023-08-21", startTime: "12:00", endTime: "13:00", status: "available", id: 101, car_plate: null, email: null },
                    { parkingLotId: 1, date: "2023-08-21", startTime: "13:00", endTime: "14:00", status: "available", id: 101, car_plate: null, email: null },
                    { parkingLotId: 1, date: "2023-08-21", startTime: "14:00", endTime: "15:00", status: "available", id: 101, car_plate: null, email: null },
                    { parkingLotId: 1, date: "2023-08-21", startTime: "15:00", endTime: "16:00", status: "available", id: 101, car_plate: null, email: null },
                    { parkingLotId: 1, date: "2023-08-21", startTime: "16:00", endTime: "17:00", status: "available", id: 101, car_plate: null, email: null },

                    { parkingLotId: 2, date: "2023-08-21", startTime: "08:00", endTime: "09:00", status: "available", id: 201, car_plate: null, email: null },
                    { parkingLotId: 2, date: "2023-08-21", startTime: "09:00", endTime: "10:00", status: "available", id: 201, car_plate: null, email: null },
                    { parkingLotId: 2, date: "2023-08-21", startTime: "10:00", endTime: "11:00", status: "available", id: 201, car_plate: null, email: null },
                    { parkingLotId: 2, date: "2023-08-21", startTime: "11:00", endTime: "12:00", status: "available", id: 201, car_plate: null, email: null },
                    { parkingLotId: 2, date: "2023-08-21", startTime: "12:00", endTime: "13:00", status: "available", id: 201, car_plate: null, email: null },
                    { parkingLotId: 2, date: "2023-08-21", startTime: "13:00", endTime: "14:00", status: "available", id: 201, car_plate: null, email: null },
                    { parkingLotId: 2, date: "2023-08-21", startTime: "14:00", endTime: "15:00", status: "available", id: 201, car_plate: null, email: null },
                    { parkingLotId: 2, date: "2023-08-21", startTime: "15:00", endTime: "16:00", status: "available", id: 201, car_plate: null, email: null },
                    { parkingLotId: 2, date: "2023-08-21", startTime: "16:00", endTime: "17:00", status: "available", id: 201, car_plate: null, email: null },
                ],

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



    methods: {

      craeteNewDate(){
        const currentDate = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format
        this.groupedFilteredSpaces = this.groupSpacesByDate(this.spaces.filter(space => {
          let matches = true;
          if (this.selectedDate < currentDate || this.selectedDate && space.date !== this.selectedDate) {
      matches = false;
    }

    const spaceIdMapping = {
      1: 101,
      2: 201,
      // Add more mappings as needed
    };

    if (!this.spaces.some(space => space.date === this.selectedDate)) {
      const parkingLotSpaces = [];

      for (const parkingLot of this.parkingLots) {
        if (!this.selectedParkingLot || parkingLot.id === this.selectedParkingLot) {
          // Use the mapping to determine the space ID
          const spaceId = spaceIdMapping[parkingLot.id];

          for (let hour = 8; hour <= 16; hour++) {
            const slotStartTime = `${hour.toString().padStart(2, '0')}:00`;
            const slotEndTime = `${(hour + 1).toString().padStart(2, '0')}:00`;

            parkingLotSpaces.push({
              parkingLotId: parkingLot.id,
              date: this.selectedDate,
              startTime: slotStartTime,
              endTime: slotEndTime,
              status: "available",
              id: spaceId,
              car_plate: null,
              email: null
            });
          }
        }
      }

      // Concatenate the new slots with the existing spaces array
      this.spaces = this.spaces.concat(parkingLotSpaces);
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

          if (this.selectedParkingLot && space.parkingLotId !== this.selectedParkingLot) {
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
            sp.id === space.id &&
            sp.date === this.selectedDate &&
            sp.status === "occupied"
          );

          // Check for overlap with each booked time range
          for (const bookedRange of bookedTimeRanges) {
            const bookedStartTime = new Date(`${this.selectedDate} ${bookedRange.startTime}`);
            const bookedEndTime = new Date(`${this.selectedDate} ${bookedRange.endTime}`);

            if (
              (selectedStartTime >= bookedStartTime && selectedStartTime < bookedEndTime) ||
              (selectedEndTime > bookedStartTime && selectedEndTime <= bookedEndTime) ||
              (selectedStartTime <= bookedStartTime && selectedEndTime >= bookedEndTime)
            ) {
              matches = false;
              break; // No need to check further, space is not available
            }
          }

          console.log("Filtering space:", space.id,space.startTime,space.endTime,space.date,space.status,space.car_plate,space.email);
          console.log("Matches:", matches);
          return matches;
        }));
      },

      groupSpacesByDate(spaces) {

        const grouped = {};
        for (const space of spaces) {
          const key = `${space.id}-${space.date}`;
          if (!grouped[key]) {
            grouped[key] = {
              parkingLotId: space.parkingLotId,
              date: space.date,
              id: space.id,
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
        pdf.text(`Parking Space ID: ${space.id}`, 10, 20);
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
        link.download = `invoice_${space.id}_${this.selectedDate}.pdf`;
        link.click();
      },

      async bookParkingSpace() {
        const selectedSpace = this.groupedFilteredSpaces.find(space => space.id === this.selectedSpaceId);

        if (selectedSpace) {
          if (this.selectedDate && this.selectedStartTime && this.selectedEndTime) {
            console.log("Booking parking space:", selectedSpace.id);
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
                space.id === selectedSpace.id &&
                space.date === this.selectedDate &&
                new Date(`${this.selectedDate} ${space.startTime}`) >= bookingStartTime &&
                new Date(`${this.selectedDate} ${space.endTime}`) <= bookingEndTime
              );

              if (originalSpace) {
                originalSpace.status = "occupied";
                originalSpace.car_plate = this.carPlate;
                originalSpace.email = this.email;
              }
              console.log(originalSpace)
            }

            // Update the status in the groupedFilteredSpaces array
            const groupedSpace = this.groupedFilteredSpaces.find(space => space.id === selectedSpace.id);
            if (groupedSpace) {
              groupedSpace.status = "occupied";
              groupedSpace.car_plate = this.carPlate;
              groupedSpace.email = this.email;
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

      disabledDate(time) {
          return time.getTime() < Date.now()
      }

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
