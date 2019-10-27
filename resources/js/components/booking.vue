<template>
  <div>
    <h2>Booking</h2>
    <form @submit.prevent="addbooking" class="mb-3">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="name" v-model="booking.name">
      </div>
     <div class="form-group">
        <input type="text" class="form-control" placeholder="type" v-model="booking.type">
      </div>
      <button type="submit" class="btn btn-light btn-block">Save</button>
    </form>
    <button @click="clearForm()" class="btn btn-danger btn-block">Cancel</button>
    <nav aria-label="Page navigation example">
     
    </nav>
    <div class="card card-body mb-2" v-for="booking in bookings" v-bind:key="booking.id">
      <h3>{{ booking.name }}</h3>
       <h3>{{ booking.type }}</h3>
        <h3>{{ booking.status }}</h3>
         <h3>{{ booking.email }}</h3>
          <h3>{{ booking.reference }}</h3>
      <hr>
      <button @click="editBooking(booking)" class="btn btn-warning mb-2">Edit</button>
      <button @click="deleteBooking(booking.id)" class="btn btn-danger">Delete</button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      bookings: [],
      booking: {
        id: '',
        name: '',
        type: '',
        email:'',
        status:'',
        reference:''
      },
      booking_id: '',
      
      edit: false
    };
  },

  created() {
    this.fetchBookings();
  },

  methods: {
    fetchBookings(page_url) {
      let vm = this;
      page_url = page_url || '/api/bookings';
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.bookings = res.data;
          
        })
        .catch(err => console.log(err));
    },
    
    deleteBooking(id) {
      if (confirm('Are You Sure?')) {
        fetch(`api/booking/${id}`, {
          method: 'delete'
        })
          .then(res => res.json())
          .then(data => {
            alert('Booking Removed');
            this.fetchBookings();
          })
          .catch(err => console.log(err));
      }
    },
    addBooking() {
      if (this.edit === false) {
        // Add
        fetch('api/booking', {
          method: 'post',
          body: JSON.stringify(this.booking),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Booking Added');
            this.fetchBookings();
          })
          .catch(err => console.log(err));
      } else {
        // Update
        fetch('api/booking', {
          method: 'put',
          body: JSON.stringify(this.booking),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(res => res.json())
          .then(data => {
            this.clearForm();
            alert('Booking Updated');
            this.fetchBookings();
          })
          .catch(err => console.log(err));
      }
    },
    editbooking(booking) {
      this.edit = true;
      this.booking.id = booking.id;
      this.booking.name = booking.name;
      this.booking.email = booking.email;
      this.booking.status = 'accepted';
    },
    clearForm() {
      this.edit = false;
      this.booking.id = null;
      this.booking.name = null;
      this.booking.email = '';
      this.booking.type = '';
    }
  }
};
</script>
