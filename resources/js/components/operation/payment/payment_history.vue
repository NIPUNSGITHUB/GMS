<template>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>
                <i class="nav-icon fas fa-user-friends"></i>&nbsp;Payment History
              </h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                  <router-link to="/">Operation</router-link>
                </li>
                <li class="breadcrumb-item active">Request History</li>
              </ol>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- Modal -->
      <!-- Employee List -->
      <div class="card">
       <div class="card-header">
            <h3 class="card-title">Payment List</h3>

            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 250px;">
                <label for></label>
                 <select @change="getPaymentDetails" class="form-control" name id v-model="rpp">
                  <option v-for="(item,index) in ppi" :key="index">{{item}}</option>
                </select>&nbsp;
               
              </div>
            </div>
          </div>
          <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 600px;">
           
          <table class="table">
            <thead>
              <tr>
                <th class="text-center">#</th>
                <th class="text-center">Customer Name</th>
                <th class="text-center">Email</th>
                <th class="text-center">Contact No.</th>
                <th class="text-center">Area</th>
                <th class="text-center">Category</th>
                <th class="text-center">Vehicle Type</th>
                <th class="text-center">Address</th>
                <th class="text-center">Date</th>
                <th class="text-center">Amount (LKR)</th>
                <th class="text-center">Status</th> 
              </tr>
            </thead>
            <tbody>
              <tr v-for="payment_detail in payment_details.data" :key="payment_detail.id">
                <td class="text-center">{{payment_detail.id}}</td>
                <td class="text-center">{{payment_detail.holder_name}}</td>
                <td class="text-center">{{payment_detail.email}}</td>
                <td class="text-center">{{payment_detail.tele_no}}</td>
                <td class="text-center">{{payment_detail.area_name}}</td>
                <td class="text-center">{{payment_detail.cate_name}}</td>
                <td class="text-center">{{payment_detail.v_type}}</td>
                <td class="text-center">{{payment_detail.address_1}},{{payment_detail.address_2}},{{payment_detail.address_3}}</td>                
                <td class="text-center">{{payment_detail.date}}</td>
                <td class="text-right">{{payment_detail.total_payment}}</td>
                <td class="text-center" v-if="payment_detail.p_status == 8" :class="payment_detail.p_status == 8?'text-warning':''">Wait</td>
                <td class="text-center" v-if="payment_detail.p_status == 7" :class="payment_detail.p_status == 7?'text-success':''">Finish</td>              
              </tr>
            </tbody>
          </table>
        </div>
           <div class="card-footer">
            <pagination
              v-if="load_data==false"
              class="float-right"
              :limit="2"
              :data="payment_details"
              @pagination-change-page="getPaymentDetails"
            ></pagination>
          </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      payment_details:'',
      load_data:true,
      rpp: 10,
      search_str: null,
      ppi: []
      
    }
  },
  mounted() {
    this.getPaymentDetails();
    this.itemPerPage();
  },
  methods: {
    itemPerPage() {
      axios.get("/prp").then(res => {
        if (res.status == 200) {
          this.ppi = res.data;
        }
      });
    },
      getPaymentDetails(page = 1)
      { this.load_data = true;
        axios.post('/get/payment/details?page=' + page,{
          rpp:this.rpp
          }).then(res=>{
          if(res.status == 200)
          {
            console.log(res);
            this.payment_details = res.data;
            this.load_data = false; 
          }
          else
          {
            consoleo.log('Error');
          }
        }).catch(error=>{
          console.log(error);
        })
      }
  },
}
</script>
    